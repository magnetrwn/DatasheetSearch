// Usa le classi tab-button per i pulsanti, tab-content per i contenuti
function openTab(tabButtonId, tabContentId) {
    // Nascondi tutti i tab a parte quello richiesto
    const tabContents = document.getElementsByClassName("tab-content");
    for (let i = 0; i < tabContents.length; i++)
        tabContents[i].classList.add("hidden");

    const tabButtons = document.getElementsByClassName("tab-button");
    for (let i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove("bg-white");
        tabButtons[i].classList.remove("text-gray-900");
    }
    document.getElementById(tabContentId).classList.remove("hidden");
    document.getElementById(tabButtonId).classList.add("bg-white");
    document.getElementById(tabButtonId).classList.add("text-gray-900");
}

function openTabByIndex(tabIndex) {
    document.getElementsByClassName("tab-content")[tabIndex].classList.remove("hidden");
    document.getElementsByClassName("tab-button")[tabIndex].classList.add("bg-white");
    document.getElementsByClassName("tab-button")[tabIndex].classList.add("text-gray-900");
}