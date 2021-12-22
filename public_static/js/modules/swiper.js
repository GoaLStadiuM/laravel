export default function swiper() {
    //querySelectors
    const modalCarrousel = document.querySelector("#modal-carrousel");
    const cardCarousel = document.querySelectorAll(".swiper-slide");
    const promptCard = document.querySelector("#prompt-card");
    const closeModal = document.querySelector("#close-modal");
    //Initializing swiper
    const swiper = new Swiper(".mySwiper", {
        effect: "cards",
        loop: true,
        allowTouchMove: false,
        autoplay: 1,
        speed: 100,
    });
    //Radnomtime carrousel
    const randomTime = Math.floor(Math.random() * (15000 - 8000)) + 8000;

    //Active Carrousel

    document.querySelectorAll(".card-goal").forEach((card) => {
        card.addEventListener("click", () => {
            swiper.autoplay.start();

            if (modalCarrousel.classList.contains("hidden")) {
                modalCarrousel.classList.remove("hidden");
                modalCarrousel.classList.add("flex");
                //Modal carrousel animation
                setTimeout(modal, randomTime);
            } else {
                modalCarrousel.classList.remove("flex");
                modalCarrousel.classList.add("hidden");
            }
        });
    });

    const modal = () => {
        swiper.autoplay.stop();
        modalCarrousel.addEventListener("click", (ev) => {
            ev.stopPropagation();
            modalCarrousel.classList.remove("flex");
            modalCarrousel.classList.add("hidden");
            window.location.reload();
        });
        //Get card info
        cardCarousel.forEach((card) => {
            const swiperIndex = swiper.realIndex;
            const cardIndex = card.dataset.index;
            if (swiperIndex === Number(cardIndex)) {
                //Creating prompt card
                const img = document.createElement("img");
                const span = document.createElement("span");

                img.src = card.src;
                img.alt = card.alt;
                img.classList.add(
                    "w-full",
                    "h-full",
                    "object-cover",
                    "rounded-t-md"
                );

                span.innerText = "Added to your team";
                span.classList.add("text-center", "text-slate-800", "my-2");
                promptCard.appendChild(img);
                promptCard.appendChild(span);
                promptCard.classList.remove("hidden");
                promptCard.classList.add(
                    "flex",
                    "animate__animated",
                    "animate__fadeInDown",
                    "animate__faster"
                );
                closeModal.classList.remove("cursor-not-allowed");
                closeModal.classList.add("cursor-pointer");
                setTimeout(() => {
                    promptCard.classList.remove("flex");
                    promptCard.classList.add("hidden");
                }, 5000);
            }
        });
    };
}
