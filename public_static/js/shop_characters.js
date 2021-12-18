//querySelector
const menuResponsive = document.querySelector("#bg-menu-responsive"),
      sidebarResponsive = document.querySelector("#sidebar-responsive"),
      btnMenu = document.querySelector("#btn-menu"),
      btnLSecond = document.querySelector("#btn-l-second"),
      btnRSecond = document.querySelector("#btn-r-second"),
      btnLThird = document.querySelector("#btn-l-third"),
      btnRThird = document.querySelector("#btn-r-third"),
      secondDiv = document.querySelector("#second-division"),
      thirdDiv = document.querySelector("#third-division"),

      //SVG
      svgX = `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
</svg>`,

      svgMenu = `<svg
xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewbox="0 0 24 24"
stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
</svg>`;

//Events

btnMenu.addEventListener("click", () => {
    if (menuResponsive.classList.contains("hidden")) {
        menuResponsive.classList.remove("hidden");
        btnMenu.innerHTML = svgX;
        sidebarResponsive.classList.add(
            "animate__animated",
            "animate__fadeInLeft",
            "animate__faster"
        );
    } else {
        menuResponsive.classList.add("hidden");
        btnMenu.innerHTML = svgMenu;
    }
});

menuResponsive.addEventListener("click", (ev) => {
    ev.stopPropagation();
    menuResponsive.classList.add("hidden");
    btnMenu.innerHTML = svgMenu;
});

btnLSecond.addEventListener("click", () => {
    secondDiv.scrollLeft -= 150;
});

btnRSecond.addEventListener("click", () => {
    secondDiv.scrollLeft += 150;
});

btnLThird.addEventListener("click", () => {
    thirdDiv.scrollLeft -= 150;
});

btnRThird.addEventListener("click", () => {
    thirdDiv.scrollLeft += 150;
});
