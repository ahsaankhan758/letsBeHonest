import '../css/app.css';
import { useState } from 'react';
import ReactDOM from "react-dom/client";
import { AnimatePresence } from 'motion/react';
import { WelcomeScreen } from './components/WelcomeScreen';
import { OnboardingFlow } from './components/OnboardingFlow';
import { BrowseView } from './components/BrowseView';
import { ProfileDetail } from './components/ProfileDetail';
import { VibeEditor } from './components/VibeEditor';
import { NotificationsView } from './components/NotificationsView';
import { MessagesView } from './components/MessagesView';
import { MyProfileView } from './components/MyProfileView';
import { ErrorBoundary } from './ErrorBoundary';
import { mockUsers } from './data/mockUsers';
import type { Vibe } from './data/mockUsers';
import type { User } from './data/mockUsers';
import { mockConversations } from './data/mockMessages';

export interface Notification {
  id: string;
  user: User;
  type: 'online' | 'vibe_change' | 'profile_view' | 'follow';
  timestamp: string;
  message: string;
  isRead: boolean;
}

function AppContent() {
  const [appState, setAppState] = useState<'welcome' | 'onboarding' | 'browse'>('welcome');
  const [interestedIn, setInterestedIn] = useState<'Men' | 'Women' | 'Everyone'>('Everyone');
  const [selectedUserId, setSelectedUserId] = useState<string | null>(null);
  const [showVibeEditor, setShowVibeEditor] = useState(false);
  const [showNotifications, setShowNotifications] = useState(false);
  const [showMessages, setShowMessages] = useState(false);
  const [showMyProfile, setShowMyProfile] = useState(false);
  const [userVibe, setUserVibe] = useState<Vibe>('Chill');
  const [notifications, setNotifications] = useState<Notification[]>([]);
  const [followedUsers, setFollowedUsers] = useState<User[]>([]);
  const [messageToUserId, setMessageToUserId] = useState<string | null>(null);

  const handleOnboardingComplete = (data: any) => {
    console.log('Onboarding complete:', data);
    setInterestedIn(data.interestedIn || 'Everyone');
    setUserVibe(data.vibe || 'Chill');
    setAppState('browse');
  };

  const handleProfileClick = (userId: string) => {
    setSelectedUserId(userId);
    setShowNotifications(false);
    setShowMessages(false);
    
    // Generate a notification (simulating someone viewing your profile back)
    const viewedUser = mockUsers.find(u => u.id === userId);
    if (viewedUser) {
      const newNotification: Notification = {
        id: `notif-${Date.now()}-${userId}`,
        user: viewedUser,
        type: 'profile_view',
        timestamp: 'Just now',
        message: 'viewed your profile',
        isRead: false
      };
      
      setNotifications(prev => [newNotification, ...prev]);
    }
  };

  const handleCloseProfile = () => {
    setSelectedUserId(null);
  };

  const handleFollow = (user: User) => {
    setFollowedUsers(prev => {
      if (!prev.find(u => u.id === user.id)) {
        return [...prev, user];
      }
      return prev;
    });
    
    const newNotification: Notification = {
      id: `notif-follow-${Date.now()}-${user.id}`,
      user: user,
      type: 'follow',
      timestamp: 'Just now',
      message: 'started following you',
      isRead: false
    };
    
    setNotifications(prev => [newNotification, ...prev]);
  };

  const handleSendMessageToUser = (userId: string) => {
    setMessageToUserId(userId);
    setShowMessages(true);
    setSelectedUserId(null);
  };

  const handleVibeClick = () => {
    setShowVibeEditor(true);
  };

  const handleVibeSave = (vibe: Vibe) => {
    setUserVibe(vibe);
  };

  const handleNotificationsClick = () => {
    setShowNotifications(true);
    setShowMessages(false);
  };

  const handleMessagesClick = () => {
    setShowMessages(true);
    setShowNotifications(false);
  };

  const handleCloseNotifications = () => {
    setShowNotifications(false);
  };

  const handleMarkNotificationsAsRead = () => {
    setNotifications(prev => prev.map(n => ({ ...n, isRead: true })));
  };

  const handleCloseMessages = () => {
    setShowMessages(false);
    setMessageToUserId(null);
  };

  const handleMyProfileClick = () => {
    setShowMyProfile(true);
  };

  const handleCloseMyProfile = () => {
    setShowMyProfile(false);
  };

  // Filter users based on preference
  const filteredUsers = mockUsers.filter((user) => {
    const userId = parseInt(user.id);
    const isMale = userId >= 101;
    const isFemale = userId <= 100;
    
    if (interestedIn === 'Everyone') return true;
    if (interestedIn === 'Men') return isMale;
    if (interestedIn === 'Women') return isFemale;
    return true;
  });

  const selectedUser = selectedUserId
    ? mockUsers.find((user) => user.id === selectedUserId)
    : null;

  const unreadMessagesCount = mockConversations.reduce(
    (sum, conv) => sum + conv.unreadCount,
    0
  );
  
  const unreadNotificationsCount = notifications.filter(n => !n.isRead).length;

  return (
    <div>
      {appState === 'welcome' && (
        <WelcomeScreen 
          onGetStarted={() => setAppState('onboarding')} 
          onLogin={() => alert('Login')} 
        />
      )}

      {appState === 'onboarding' && (
        <OnboardingFlow onComplete={handleOnboardingComplete} />
      )}

      {appState === 'browse' && (
        <BrowseView
          users={filteredUsers}
          onProfileClick={handleProfileClick}
          onVibeClick={handleVibeClick}
          onNotificationsClick={handleNotificationsClick}
          onMessagesClick={handleMessagesClick}
          onMyProfileClick={handleMyProfileClick}
          unreadMessages={unreadMessagesCount}
          unreadNotifications={unreadNotificationsCount}
        />
      )}

      <AnimatePresence>
        {selectedUser && (
          <ProfileDetail 
            user={selectedUser} 
            onClose={handleCloseProfile} 
            onSendMessage={handleSendMessageToUser} 
            onFollow={handleFollow} 
          />
        )}
      </AnimatePresence>

      <AnimatePresence>
        {showVibeEditor && (
          <VibeEditor
            currentVibe={userVibe}
            onSave={handleVibeSave}
            onClose={() => setShowVibeEditor(false)}
          />
        )}
      </AnimatePresence>

      <AnimatePresence>
        {showNotifications && (
          <NotificationsView
            onClose={handleCloseNotifications}
            followedUsers={followedUsers}
            onProfileClick={handleProfileClick}
            notifications={notifications}
            onMarkAsRead={handleMarkNotificationsAsRead}
          />
        )}
      </AnimatePresence>

     

      <AnimatePresence>
        {showMyProfile && (
          <MyProfileView
            onClose={handleCloseMyProfile}
            userId="current-user"
          />
        )}
      </AnimatePresence>
    </div>
  );
}

export default function App() {
  return (
    <ErrorBoundary>
      <AppContent />
    </ErrorBoundary>
  );
}

