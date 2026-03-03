import { motion } from 'motion/react';

interface WelcomeScreenProps {
  onGetStarted: () => void;
  onLogin: () => void;
}

export function WelcomeScreen({ onGetStarted, onLogin }: WelcomeScreenProps) {
  return (
    <div className="min-h-screen bg-white flex flex-col items-center justify-center px-6 py-12">
      <motion.div 
        initial={{ opacity: 0, y: 20 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.8 }}
        className="max-w-5xl w-full text-center"
      >
        {/* Eyebrow text */}
        <motion.p 
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.2 }}
          className="text-neutral-400 mb-12"
          style={{ 
            fontFamily: 'var(--font-sans)',
            fontSize: '0.875rem',
            letterSpacing: '0.2em',
            textTransform: 'uppercase'
          }}
        >
          A new way to connect
        </motion.p>

        {/* Main headline */}
        <motion.h1 
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.4 }}
          className="mb-16"
          style={{ 
            fontFamily: 'var(--font-serif)',
            fontSize: 'clamp(3.5rem, 10vw, 8rem)',
            fontWeight: 400,
            lineHeight: 1.05,
            letterSpacing: '-0.03em'
          }}
        >
          Let's Be Honest
        </motion.h1>

        {/* Subtitle */}
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.6 }}
          className="max-w-3xl mx-auto space-y-8 mb-20"
        >
          <p 
            className="text-neutral-600 leading-relaxed"
            style={{ 
              fontFamily: 'var(--font-sans)',
              fontSize: 'clamp(1.25rem, 2.5vw, 1.75rem)',
              fontWeight: 300,
              lineHeight: 1.6
            }}
          >
            A sophisticated space where adults express what they want and connect with people who align.
          </p>
          <p 
            className="text-neutral-600 leading-relaxed"
            style={{ 
              fontFamily: 'var(--font-sans)',
              fontSize: 'clamp(1.25rem, 2.5vw, 1.75rem)',
              fontWeight: 300,
              lineHeight: 1.6
            }}
          >
            No games. No swiping. Just honest intention.
          </p>
        </motion.div>

        {/* CTA Button */}
        <motion.button
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.8 }}
          onClick={onGetStarted}
          className="bg-black text-white px-16 py-6 hover:bg-neutral-800 transition-colors"
          style={{ 
            fontFamily: 'var(--font-sans)',
            fontSize: '1.125rem',
            letterSpacing: '0.05em',
            fontWeight: 600
          }}
        >
          Enter
        </motion.button>

        {/* Login link */}
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.9 }}
          className="mt-6"
        >
          <p 
            className="text-neutral-500"
            style={{ 
              fontFamily: 'var(--font-sans)',
              fontSize: '1rem'
            }}
          >
            Already have an account?{' '}
            <button
              onClick={onLogin}
              className="text-black underline hover:text-neutral-600 transition-colors font-semibold"
            >
              Log In
            </button>
          </p>
        </motion.div>
      </motion.div>
    </div>
  );
}