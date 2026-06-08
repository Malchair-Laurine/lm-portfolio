document.addEventListener('DOMContentLoaded', () => {


    // AVATAR PARCOURS — désactivé sur mobile

    if (window.innerWidth > 768) {
        const stepsContainer = document.querySelector('.course__steps');
        const avatar = document.querySelector('.course__main-image');

        if (stepsContainer && avatar) {
            function updateAvatarPosition() {
                const rect = stepsContainer.getBoundingClientRect();
                const totalHeight = rect.height;
                const triggerZone = window.innerHeight * 0.35;
                const currentScroll = triggerZone - rect.top;

                let progress = currentScroll / totalHeight;
                progress = Math.max(0, Math.min(1, progress));

                const targetY = progress * totalHeight;
                const nombreDeVagues = 4;
                const amplitudePixels = 300;
                const angle = progress * Math.PI * 2 * nombreDeVagues;
                const targetX = Math.sin(angle) * amplitudePixels;

                avatar.style.transform = `translate(${targetX}px, ${targetY}px)`;
            }

            window.addEventListener('scroll', updateAvatarPosition);
            window.addEventListener('resize', updateAvatarPosition);
            updateAvatarPosition();
        }
    }


    // TYPEMACHINE

    const typemachineBlock = document.querySelector(".typemachine");
    const textElement = document.querySelector(".typemachine__text");

    if (textElement && typemachineBlock) {
        const fullText = textElement.textContent.trim();
        textElement.textContent = "";

        let index = 0;
        const speed = 80;

        function type() {
            if (index < fullText.length) {
                textElement.textContent += fullText.charAt(index);
                index++;
                setTimeout(type, speed);
            } else {
                textElement.style.borderRight = "none";

                setTimeout(() => {
                    typemachineBlock.style.transition = "opacity 0.5s ease, visibility 0.5s";
                    typemachineBlock.style.opacity = "0";
                    typemachineBlock.style.visibility = "hidden";

                    setTimeout(() => {
                        typemachineBlock.style.display = "none";
                    }, 500);
                }, 2000);
            }
        }

        setTimeout(type, 200);
    }
});


// NAVIGATION — apparition après typemachine

const nav = document.querySelector('.main-header');
const typemachine = document.querySelector('.typemachine');

if (typemachine) {
    const observer = new IntersectionObserver(([entry]) => {
        nav.classList.toggle('main-header--visible', !entry.isIntersecting);
    }, { threshold: 0 });

    observer.observe(typemachine);

    if (window.innerWidth <= 768) {
        nav.classList.add('main-header--visible');
    }
} else {
    nav.classList.add('main-header--visible');
}