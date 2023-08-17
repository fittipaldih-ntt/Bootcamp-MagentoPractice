require(['jquery'], function($) {
    $(document).ready(function() {
        const generationsLists = document.querySelectorAll(".generations-list");
        const regionsLists = document.querySelectorAll(".regions-list");

        generationsLists.forEach((list) => {
            const title = list.previousElementSibling;
            title.classList.add("clickable-title");

            title.addEventListener("click", () => {
                list.style.display = list.style.display === "none" ? "block" : "none";
            });
        });

        regionsLists.forEach((list) => {
            const title = list.previousElementSibling;
            title.classList.add("clickable-title");

            title.addEventListener("click", () => {
                list.style.display = list.style.display === "none" ? "block" : "none";
            });
        });
    });
});
