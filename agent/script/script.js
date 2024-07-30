function showNotification(message, type = "success") {
  // console.log("Notification");
  const notification = document.createElement("div");
  notification.className = `notification ${type}`;
  notification.textContent = message;
  document.body.appendChild(notification);

  setTimeout(() => {
    notification.classList.add("fade-out");
    notification.addEventListener("transitionend", () => {
      notification.remove();
    });
  }, 3000);
}

function toggleDropdown() {
  const dropdown = document.getElementById("userDropdown");
  dropdown.classList.toggle("show");
}
window.onclick = function (event) {
  if (
    !event.target.matches(".user-icon") &&
    !event.target.matches(".user-text")
  ) {
    const dropdowns = document.getElementsByClassName("dropdown-menu");
    for (let i = 0; i < dropdowns.length; i++) {
      const openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};
function getcookie(name) {
  let cookieArray = document.cookie.split(";");
  for (let i = 0; i < cookieArray.length; i++) {
    let cookiePair = cookieArray[i].trim().split("=");
    if (cookiePair[0] == name) {
      return decodeURIComponent(cookiePair[1]);
    }
  }
}