function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburger1 = document.getElementById('hamburger-1');
    const hamburger2 = document.getElementById('hamburger-2');
    const hamburger3 = document.getElementById('hamburger-3');
    
    if (mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.remove('hidden');
        mobileMenu.style.animation = 'slideDown 0.3s ease-out';
        
        hamburger1.style.transform = 'rotate(45deg) translateY(4px)';
        hamburger2.style.opacity = '0';
        hamburger3.style.transform = 'rotate(-45deg) translateY(-4px)';
    } else {
        mobileMenu.style.animation = 'slideUp 0.3s ease-in';
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 250);
        
        hamburger1.style.transform = 'rotate(0) translateY(0)';
        hamburger2.style.opacity = '1';
        hamburger3.style.transform = 'rotate(0) translateY(0)';
    }
}

function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburger1 = document.getElementById('hamburger-1');
    const hamburger2 = document.getElementById('hamburger-2');
    const hamburger3 = document.getElementById('hamburger-3');
    
    if (!mobileMenu.classList.contains('hidden')) {
        mobileMenu.style.animation = 'slideUp 0.3s ease-in';
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 250);
        
        hamburger1.style.transform = 'rotate(0) translateY(0)';
        hamburger2.style.opacity = '1';
        hamburger3.style.transform = 'rotate(0) translateY(0)';
    }
}

function openSignupModal() {
    const modal = document.getElementById('signupModal');
    const modalContent = document.getElementById('modalContent');
    const form = document.getElementById('signupForm');
    const successMessage = document.getElementById('successMessage');
    
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    setTimeout(() => {
        modalContent.style.transform = 'scale(1)';
        modalContent.style.opacity = '1';
    }, 50);
    
    form.style.display = 'block';
    successMessage.classList.add('hidden');
    form.reset();
}

function closeSignupModal() {
    const modal = document.getElementById('signupModal');
    const modalContent = document.getElementById('modalContent');
    
    modalContent.style.transform = 'scale(0.95)';
    modalContent.style.opacity = '0.95';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerButton = event.target.closest('button');
        
        if (!hamburgerButton && !mobileMenu.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
            closeMobileMenu();
        }
    });
    
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            closeMobileMenu();
        }
    });
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                closeMobileMenu();
            }
        });
    });

    document.getElementById('signupForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = document.getElementById('signupForm');
        const successMessage = document.getElementById('successMessage');
        
        setTimeout(() => {
            form.style.display = 'none';
            successMessage.classList.remove('hidden');
        }, 500);
    });

    document.getElementById('signupModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSignupModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('signupModal');
            if (!modal.classList.contains('hidden')) {
                closeSignupModal();
            }
        }
    });
});
