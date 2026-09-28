"use strict";

document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;
    const openMenuButton = document.querySelector("[data-menu-open]");
    const closeMenuButton = document.querySelector("[data-menu-close]");
    const menuBackdrop = document.querySelector("[data-menu-backdrop]");
    const sideMenu = document.querySelector("[data-side-menu]");

    const setMenuState = (isOpen) => {
        body.classList.toggle("menu-is-open", isOpen);
        openMenuButton?.setAttribute("aria-expanded", String(isOpen));
        sideMenu?.setAttribute("aria-hidden", String(!isOpen));

        if (isOpen) {
            closeMenuButton?.focus();
        } else {
            openMenuButton?.focus();
        }
    };

    openMenuButton?.addEventListener("click", () => setMenuState(true));
    closeMenuButton?.addEventListener("click", () => setMenuState(false));
    menuBackdrop?.addEventListener("click", () => setMenuState(false));

    sideMenu?.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", () => setMenuState(false));
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && body.classList.contains("menu-is-open")) {
            setMenuState(false);
        }
    });

    const imageModal = document.querySelector("[data-image-modal]");
    const modalImage = imageModal?.querySelector("[data-image-modal-content]");
    const closeImageModalButton = imageModal?.querySelector("[data-image-modal-close]");

    const closeImageModal = () => {
        imageModal?.close();
        body.classList.remove("image-modal-is-open");
    };

    document.querySelectorAll("[data-image-preview]").forEach((previewButton) => {
        previewButton.addEventListener("click", () => {
            const sourceImage = previewButton.querySelector("img");

            if (!imageModal || !modalImage || !sourceImage) {
                return;
            }

            modalImage.src = sourceImage.currentSrc || sourceImage.src;
            modalImage.alt = sourceImage.alt;
            body.classList.add("image-modal-is-open");
            imageModal.showModal();
        });
    });

    closeImageModalButton?.addEventListener("click", closeImageModal);
    imageModal?.addEventListener("click", (event) => {
        if (event.target === imageModal) {
            closeImageModal();
        }
    });

    imageModal?.addEventListener("close", () => {
        body.classList.remove("image-modal-is-open");
    });

    const carousel = document.querySelector("[data-carousel]");

    if (!carousel) {
        return;
    }

    const slides = Array.from(carousel.querySelectorAll("[data-carousel-slide]"));
    const dots = Array.from(carousel.querySelectorAll("[data-carousel-dot]"));
    const previousButton = carousel.querySelector("[data-carousel-previous]");
    const nextButton = carousel.querySelector("[data-carousel-next]");
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    let activeIndex = 0;
    let autoplayTimer;

    const showSlide = (requestedIndex) => {
        activeIndex = (requestedIndex + slides.length) % slides.length;

        slides.forEach((slide, index) => {
            const isActive = index === activeIndex;

            slide.classList.toggle("is-active", isActive);
            slide.setAttribute("aria-hidden", String(!isActive));
        });

        dots.forEach((dot, index) => {
            const isActive = index === activeIndex;

            dot.classList.toggle("is-active", isActive);
            dot.setAttribute("aria-current", String(isActive));
        });
    };

    const stopAutoplay = () => window.clearInterval(autoplayTimer);
    const startAutoplay = () => {
        if (!prefersReducedMotion) {
            stopAutoplay();
            autoplayTimer = window.setInterval(() => showSlide(activeIndex + 1), 6500);
        }
    };

    previousButton?.addEventListener("click", () => {
        showSlide(activeIndex - 1);
        startAutoplay();
    });

    nextButton?.addEventListener("click", () => {
        showSlide(activeIndex + 1);
        startAutoplay();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            showSlide(index);
            startAutoplay();
        });
    });

    carousel.addEventListener("mouseenter", stopAutoplay);
    carousel.addEventListener("mouseleave", startAutoplay);
    carousel.addEventListener("focusin", stopAutoplay);
    carousel.addEventListener("focusout", startAutoplay);

    showSlide(0);
    startAutoplay();
});
