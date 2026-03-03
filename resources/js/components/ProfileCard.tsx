import { User } from '../data/mockUsers';
import { Sparkles, Flame } from 'lucide-react';

interface ProfileCardProps {
  user: User;
  onClick: () => void;
}

export function ProfileCard({ user, onClick }: ProfileCardProps) {
  return (
    <div
      onClick={onClick}
      className="group cursor-pointer bg-white border border-neutral-200 overflow-hidden hover:shadow-lg transition-all duration-300 md:border md:border-neutral-200"
    >
      {/* Image */}
      <div className="relative aspect-[3/4] overflow-hidden bg-neutral-100">
        <img
          src={user.images[0]}
          alt={user.name}
          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        />
        {user.isOnline && (
          <div className="absolute top-3 md:top-4 right-3 md:right-4 w-2.5 md:w-3 h-2.5 md:h-3 bg-green-400 rounded-full border-2 border-white" />
        )}
      </div>

      {/* Info */}
      <div className="p-3 md:p-6 space-y-2 md:space-y-4">
        {/* Vibe Badge */}
        <div className="inline-flex items-center gap-1 md:gap-1.5 bg-black text-white px-2 md:px-3 py-1 md:py-1.5 rounded-full">
          <Sparkles className="w-2.5 md:w-3.5 h-2.5 md:h-3.5" />
          <span style={{ fontFamily: 'var(--font-sans)', fontSize: '0.6875rem', fontWeight: 500 }} className="md:text-xs">
            {user.currentVibe}
          </span>
        </div>

        {/* Name & Age */}
        <h3
          style={{
            fontFamily: 'var(--font-serif)',
            fontSize: '1.125rem',
            fontWeight: 400,
            letterSpacing: '-0.01em'
          }}
          className="md:text-2xl flex items-center gap-1.5"
        >
          <span>{user.name}, {user.age}</span>
          {user.featured && (
            <span className="text-base md:text-xl">🔥</span>
          )}
          {user.verified && (
            <span className="text-base md:text-xl">💳</span>
          )}
        </h3>

        {/* Location */}
        <p className="text-neutral-500" style={{ fontFamily: 'var(--font-sans)', fontSize: '0.8125rem' }}>
          {user.location}
        </p>

        {/* Bio Preview - hidden on mobile */}
        <p
          className="text-neutral-700 line-clamp-2 hidden md:block"
          style={{ fontFamily: 'var(--font-sans)', fontSize: '0.9375rem', lineHeight: 1.6 }}
        >
          {user.bio}
        </p>
      </div>
    </div>
  );
}