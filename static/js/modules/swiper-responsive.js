export default function swiperResponsive() {
    //querysSelectors
    const btnLFirstMobile = document.querySelector("#btn-l-first-responsive");
    const btnRFirstMobile = document.querySelector("#btn-r-first-responsive");
    const btnLSecondMobile = document.querySelector("#btn-l-second-responsive");
    const btnRSecondMobile = document.querySelector("#btn-r-second-responsive");
    const btnLThirdMobile = document.querySelector("#btn-l-third-responsive");
    const btnRThirdMobile = document.querySelector("#btn-r-third-responsive");

    const firstDiv = document.querySelector("#first-division");
    const secondDiv = document.querySelector("#second-division");
    const thirdDiv = document.querySelector("#third-division");

    //Event Listeners
    btnLFirstMobile.addEventListener("click", () => {
        firstDiv.scrollLeft -= 151;
    });

    btnRFirstMobile.addEventListener("click", () => {
        firstDiv.scrollLeft += 151;
    });

    btnLSecondMobile.addEventListener("click", () => {
        secondDiv.scrollLeft -= 151;
    });

    btnRSecondMobile.addEventListener("click", () => {
        secondDiv.scrollLeft += 151;
    });

    btnLThirdMobile.addEventListener("click", () => {
        thirdDiv.scrollLeft -= 151;
    });

    btnRThirdMobile.addEventListener("click", () => {
        thirdDiv.scrollLeft += 151;
    });
}
