// assets/js/script.js

document.addEventListener("DOMContentLoaded", () => {
    // Exemple de petite interaction pour valider le panier
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", () => {
            alert("Produit ajouté au panier !");
        });
    });
});
