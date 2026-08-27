/**
 * Virtud y Victoria Nº 277 - Main JavaScript
 * @package Virtud_Y_Victoria
 */

document.addEventListener('DOMContentLoaded', function() {
    initHeroSlider();
    initMobileMenu();
    initBackToTop();
    initFaqAccordion();
    initGalleryFilters();
    initLazyLoading();
    initSmoothScroll();
    initScrollAnimations();
    initParallax();
    initCountUp();
});

/* ===================================
   HERO SLIDER
   =================================== */

function initHeroSlider() {
    const slider = document.getElementById('heroSlider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-slider-dot');
    const prevBtn = document.querySelector('.hero-slider-prev');
    const nextBtn = document.querySelector('.hero-slider-next');

    if (slides.length === 0) return;

    let currentSlide = 0;
    let autoPlayInterval = null;
    const autoPlayDelay = 6000;

    function goToSlide(index) {
        slides.forEach(function(slide) {
            slide.classList.remove('active');
        });
        dots.forEach(function(dot) {
            dot.classList.remove('active');
        });

        currentSlide = index;
        if (currentSlide >= slides.length) currentSlide = 0;
        if (currentSlide < 0) currentSlide = slides.length - 1;

        slides[currentSlide].classList.add('active');
        if (dots[currentSlide]) {
            dots[currentSlide].classList.add('active');
        }
    }

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function prevSlide() {
        goToSlide(currentSlide - 1);
    }

    function startAutoPlay() {
        stopAutoPlay();
        autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            nextSlide();
            startAutoPlay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            prevSlide();
            startAutoPlay();
        });
    }

    dots.forEach(function(dot) {
        dot.addEventListener('click', function() {
            var slideIndex = parseInt(this.getAttribute('data-slide'));
            goToSlide(slideIndex);
            startAutoPlay();
        });
    });

    // Pause on hover
    slider.addEventListener('mouseenter', stopAutoPlay);
    slider.addEventListener('mouseleave', startAutoPlay);

    // Touch support
    var touchStartX = 0;
    var touchEndX = 0;

    slider.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
        stopAutoPlay();
    }, { passive: true });

    slider.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        var diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
        startAutoPlay();
    }, { passive: true });

    // Start
    startAutoPlay();
}

/* ===================================
   MOBILE MENU
   =================================== */

function initMobileMenu() {
    var toggle = document.querySelector('.mobile-menu-toggle');
    var nav = document.querySelector('.main-nav');
    var overlay = document.querySelector('.mobile-menu-overlay');

    if (!toggle || !nav) return;

    function openMenu() {
        nav.classList.add('is-open');
        toggle.classList.add('is-active');
        toggle.setAttribute('aria-expanded', 'true');
        if (overlay) overlay.classList.add('is-visible');
        document.body.style.overflow = 'hidden';
        
        // Set focus to first menu item for accessibility
        var firstLink = nav.querySelector('a');
        if (firstLink) {
            setTimeout(function() {
                firstLink.focus();
            }, 100);
        }
    }

    function closeMenu() {
        nav.classList.remove('is-open');
        toggle.classList.remove('is-active');
        toggle.setAttribute('aria-expanded', 'false');
        if (overlay) overlay.classList.remove('is-visible');
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', function() {
        if (nav.classList.contains('is-open')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    if (overlay) {
        overlay.addEventListener('click', closeMenu);
    }

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && nav.classList.contains('is-open')) {
            closeMenu();
            toggle.focus(); // Return focus to toggle button
        }
    });

    // Focus trap for mobile menu (accessibility)
    function trapFocus(e) {
        if (!nav.classList.contains('is-open')) return;
        
        if (e.key === 'Tab') {
            const focusableElements = nav.querySelectorAll(
                'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'
            );
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                }
            } else {
                if (document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        }
    }

    nav.addEventListener('keydown', trapFocus);

    // Close on resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && nav.classList.contains('is-open')) {
            closeMenu();
        }
    });

    // Submenu toggle for dropdowns
    var hasChildren = nav.querySelectorAll('.menu-item-has-children');
    hasChildren.forEach(function(item) {
        var link = item.querySelector('a');
        var subMenu = item.querySelector('.sub-menu');
        if (link && subMenu) {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    item.classList.toggle(' submenu-open');
                }
            });
        }
    });
}

/* ===================================
   BACK TO TOP
   =================================== */

function initBackToTop() {
    var btn = document.getElementById('backToTop');
    if (!btn) return;

    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            btn.classList.add('is-visible');
        } else {
            btn.classList.remove('is-visible');
        }
    });

    btn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/* ===================================
   FAQ ACCORDION
   =================================== */

function initFaqAccordion() {
    var faqItems = document.querySelectorAll('.faq-item');
    if (faqItems.length === 0) return;

    faqItems.forEach(function(item) {
        var question = item.querySelector('.faq-question');
        var answer = item.querySelector('.faq-answer');

        if (!question || !answer) return;

        question.addEventListener('click', function() {
            var isOpen = item.classList.contains('is-open');

            // Close all others
            faqItems.forEach(function(otherItem) {
                otherItem.classList.remove('is-open');
                var otherAnswer = otherItem.querySelector('.faq-answer');
                if (otherAnswer) otherAnswer.style.maxHeight = null;
            });

            // Toggle current
            if (!isOpen) {
                item.classList.add('is-open');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });
}

/* ===================================
   GALLERY FILTERS
   =================================== */

function initGalleryFilters() {
    var filterBtns = document.querySelectorAll('.gallery-filter-btn');
    var galleryItems = document.querySelectorAll('.gallery-item[data-album]');

    if (filterBtns.length === 0 || galleryItems.length === 0) return;

    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var filter = this.getAttribute('data-filter');

            // Validate filter value
            if (!filter || (filter !== 'all' && !isValidAlbum(filter))) {
                console.warn('Invalid filter value:', filter);
                return;
            }

            // Update active state
            filterBtns.forEach(function(b) { b.classList.remove('is-active'); });
            this.classList.add('is-active');

            // Filter items with validation
            galleryItems.forEach(function(item) {
                var itemAlbum = item.getAttribute('data-album');
                
                if (!itemAlbum) {
                    console.warn('Gallery item missing data-album attribute:', item);
                    item.style.display = 'none';
                    return;
                }

                if (filter === 'all' || itemAlbum === filter) {
                    item.style.display = '';
                    item.style.opacity = '0';
                    setTimeout(function() {
                        item.style.opacity = '1';
                    }, 50);
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Helper function to validate album names
    function isValidAlbum(album) {
        // Only allow alphanumeric, hyphens, and underscores
        return /^[a-zA-Z0-9_-]+$/.test(album);
    }
}

/* ===================================
   LAZY LOADING
   =================================== */

function initLazyLoading() {
    var images = document.querySelectorAll('img[data-src]');
    if (images.length === 0) return;

    if ('IntersectionObserver' in window) {
        var imageObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    img.src = img.dataset.src;
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                    img.removeAttribute('data-src');
                    img.classList.add('is-loaded');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '100px'
        });

        images.forEach(function(img) {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for older browsers
        images.forEach(function(img) {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
        });
    }
}

/* ===================================
   SMOOTH SCROLL
   =================================== */

function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;

            var target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/* ===================================
   SCROLL ANIMATIONS (IntersectionObserver)
   =================================== */

function initScrollAnimations() {
    // Observe both [data-animate] and [data-animate-stagger] elements
    var animatedElements = document.querySelectorAll('[data-animate], [data-animate-stagger]');
    if (animatedElements.length === 0) return;

    if ('IntersectionObserver' in window) {
        var animationObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var delay = el.getAttribute('data-animate-delay') || 0;
                    var duration = el.getAttribute('data-animate-duration') || '';

                    setTimeout(function() {
                        el.classList.add('is-animated');
                        if (duration) {
                            el.style.animationDuration = duration + 'ms';
                        }
                    }, parseInt(delay));

                    animationObserver.unobserve(el);
                }
            });
        }, {
            threshold: 0.10,
            rootMargin: '0px 0px -30px 0px'
        });

        animatedElements.forEach(function(el) {
            animationObserver.observe(el);
        });
    } else {
        // Fallback: show all immediately
        animatedElements.forEach(function(el) {
            el.classList.add('is-animated');
        });
    }
}

/* ===================================
   PARALLAX EFFECT
   =================================== */

function initParallax() {
    var parallaxElements = document.querySelectorAll('[data-parallax]');
    if (parallaxElements.length === 0) return;

    window.addEventListener('scroll', function() {
        var scrollY = window.pageYOffset;

        parallaxElements.forEach(function(el) {
            var speed = parseFloat(el.getAttribute('data-parallax')) || 0.3;
            var rect = el.getBoundingClientRect();
            var elementTop = rect.top + scrollY;
            var elementHeight = rect.height;
            var windowHeight = window.innerHeight;

            // Only animate when element is in viewport
            if (scrollY + windowHeight > elementTop && scrollY < elementTop + elementHeight) {
                var yPos = (scrollY - elementTop) * speed;
                el.style.backgroundPositionY = yPos + 'px';
            }
        });
    }, { passive: true });
}

/* ===================================
   COUNT UP ANIMATION
   =================================== */

function initCountUp() {
    var counters = document.querySelectorAll('[data-count]');
    if (counters.length === 0) return;

    if ('IntersectionObserver' in window) {
        var countObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCount(entry.target);
                    countObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(function(counter) {
            countObserver.observe(counter);
        });
    }
}

function animateCount(el) {
    var target = parseInt(el.getAttribute('data-count')) || 0;
    var duration = parseInt(el.getAttribute('data-count-duration')) || 2000;
    var start = 0;
    var startTime = null;

    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = Math.min((timestamp - startTime) / duration, 1);
        // Ease out quad
        var eased = progress * (2 - progress);
        var current = Math.floor(eased * target);
        el.textContent = current;
        if (progress < 1) {
            requestAnimationFrame(step);
        } else {
            el.textContent = target;
        }
    }

    requestAnimationFrame(step);
}
