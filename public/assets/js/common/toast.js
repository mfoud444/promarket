
// toast.js
function showToast(message) {
  
    const toast = document.getElementById("toast");
    const toastContent = document.getElementById("toast-content");

    toastContent.innerHTML = message;
    toast.style.display = "block";

    setTimeout(() => {
        toast.style.display = "none";
    }, 60000); // Hide the toast after 3 seconds (adjust as needed)
}
