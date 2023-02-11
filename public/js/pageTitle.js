let docTitle = document.title;
window.addEventListener("blur", () =>{document.title = "Vraťte se brzy";})
window.addEventListener("focus", () =>{document.title = docTitle;})