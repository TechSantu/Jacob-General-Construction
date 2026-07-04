// Banner Slider
const banner = document.querySelector(".banner_slider");

if (banner) {
    const track = banner.querySelector(".banner_track");
    const slides = banner.querySelectorAll(".banner_slide");
    const prevButton = banner.querySelector(".banner_prev");
    const nextButton = banner.querySelector(".banner_next");
    let activeSlide = 0;
    let autoTimer = null;

    const showSlide = (index) => {
        activeSlide = (index + slides.length) % slides.length;
        track.style.transform = `translateX(-${activeSlide * 100}%)`;
    };

    const startAuto = () => {
        stopAuto();
        autoTimer = setInterval(() => showSlide(activeSlide + 1), 5000);
    };

    const stopAuto = () => {
        if (autoTimer) clearInterval(autoTimer);
    };

    if (prevButton) {
        prevButton.addEventListener("click", () => {
            showSlide(activeSlide - 1);
            startAuto();
        });
    }
    if (nextButton) {
        nextButton.addEventListener("click", () => {
            showSlide(activeSlide + 1);
            startAuto();
        });
    }

    banner.addEventListener("mouseenter", stopAuto);
    banner.addEventListener("mouseleave", startAuto);

    startAuto();
}

// Reusable carousel — handles both testimonials and gallery sliders
function initCarousel(config) {
    const section = document.querySelector(config.sectionSelector);
    if (!section) return;

    const track = section.querySelector(config.trackSelector);
    const items = section.querySelectorAll(config.itemSelector);
    const prevBtn = section.querySelector(config.prevSelector);
    const nextBtn = section.querySelector(config.nextSelector);
    const dotsContainer = section.querySelector(config.dotsSelector);
    const total = items.length;
    if (total === 0) return;

    let current = 0;
    let autoTimer = null;
    const autoDelay = config.autoDelay || 4000;

    const getVisible = () => {
        const w = window.innerWidth;
        if (w > 900) return 3;
        if (w > 560) return 2;
        return 1;
    };

    const getMaxIndex = () => Math.max(0, total - getVisible());

    function renderDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = "";
        const count = getMaxIndex() + 1;
        if (count <= 1) return;

        for (let i = 0; i < count; i++) {
            const dot = document.createElement("span");
            dot.className = "dot" + (i === current ? " active" : "");
            dot.addEventListener("click", () => {
                goTo(i);
                startAuto();
            });
            dotsContainer.appendChild(dot);
        }
    }

    function goTo(index) {
        const maxIdx = getMaxIndex();
        if (index < 0) index = maxIdx;
        if (index > maxIdx) index = 0;
        current = index;

        const itemWidth = items[0].getBoundingClientRect().width;
        const gap = parseFloat(window.getComputedStyle(track).gap) || 0;
        track.style.transform = `translateX(-${current * (itemWidth + gap)}px)`;

        if (dotsContainer) {
            const dots = dotsContainer.querySelectorAll(".dot");
            dots.forEach((d, i) => d.classList.toggle("active", i === current));
        }
    }

    function startAuto() {
        stopAuto();
        autoTimer = setInterval(() => goTo(current + 1), autoDelay);
    }

    function stopAuto() {
        if (autoTimer) clearInterval(autoTimer);
    }

    if (prevBtn) {
        prevBtn.addEventListener("click", () => { goTo(current - 1); startAuto(); });
    }
    if (nextBtn) {
        nextBtn.addEventListener("click", () => { goTo(current + 1); startAuto(); });
    }

    // Pause on hover
    const hoverTarget = section.querySelector(config.containerSelector);
    if (hoverTarget) {
        hoverTarget.addEventListener("mouseenter", stopAuto);
        hoverTarget.addEventListener("mouseleave", startAuto);
    }

    // Recalculate on resize
    window.addEventListener("resize", () => {
        current = Math.min(current, getMaxIndex());
        renderDots();
        goTo(current);
    });

    renderDots();
    startAuto();
}

// Testimonials slider
initCarousel({
    sectionSelector: ".testimonials_section",
    trackSelector: ".testimonials_track",
    itemSelector: ".testimonial_card",
    prevSelector: ".prev_arrow",
    nextSelector: ".next_arrow",
    dotsSelector: ".slider_dots",
    containerSelector: ".testimonials_slider_container",
    autoDelay: 4000
});

// Gallery slider
initCarousel({
    sectionSelector: ".gallery_section",
    trackSelector: ".gallery_track",
    itemSelector: ".gallery_item",
    prevSelector: ".gallery_prev",
    nextSelector: ".gallery_next",
    dotsSelector: ".gallery_dots",
    containerSelector: ".gallery_slider_container",
    autoDelay: 4500
});

// FAQ Accordion
const faqTriggers = document.querySelectorAll(".faq_trigger");
faqTriggers.forEach((trigger) => {
    trigger.addEventListener("click", () => {
        const item = trigger.parentElement;
        const panel = item.querySelector(".faq_panel");
        const icon = trigger.querySelector(".toggle_icon");
        
        const isActive = item.classList.contains("active");
        
        // Close all other items first
        document.querySelectorAll(".faq_item").forEach((el) => {
            el.classList.remove("active");
            el.querySelector(".faq_panel").style.maxHeight = null;
            const toggleIcon = el.querySelector(".toggle_icon");
            if (toggleIcon) toggleIcon.className = "fa-solid fa-plus toggle_icon";
        });
        
        if (!isActive) {
            item.classList.add("active");
            panel.style.maxHeight = panel.scrollHeight + "px";
            if (icon) icon.className = "fa-solid fa-xmark toggle_icon";
        }
    });
});

// Open the first FAQ item by default on page load
document.querySelectorAll(".faq_accordion").forEach((accordion) => {
    const firstTrigger = accordion.querySelector(".faq_trigger");
    if (firstTrigger) {
        firstTrigger.click();
    }
});
