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
function toggleProjectDropdown(){
  document.getElementById("project-dropdown-content").classList.toggle("show");
  document.getElementById("dropdown-content").classList.remove("show");
  document.getElementById("location-dropdown-content").classList.remove("show");
  document.getElementById("customer-dropdown-content").classList.remove("show");
}
function toggleSkillDropdown(){
  document.getElementById("dropdown-content").classList.toggle("show");
  document.getElementById("project-dropdown-content").classList.remove("show");
  document.getElementById("location-dropdown-content").classList.remove("show");
  document.getElementById("customer-dropdown-content").classList.remove("show");
}
function toggleLocationDropdown(){
  document.getElementById("location-dropdown-content").classList.toggle("show");
  document.getElementById("project-dropdown-content").classList.remove("show");
  document.getElementById("dropdown-content").classList.remove("show");
  document.getElementById("customer-dropdown-content").classList.remove("show");
}
function toggleCustomerDropdown(){
  document.getElementById("customer-dropdown-content").classList.toggle("show");
  document.getElementById("project-dropdown-content").classList.remove("show");
  document.getElementById("dropdown-content").classList.remove("show");
  document.getElementById("location-dropdown-content").classList.remove("show");
}

function toggleDropdown() {
  const dropdown = document.getElementById("userDropdown");
  dropdown.classList.toggle("show");
  document.getElementById("customer-dropdown-content").classList.remove("show");
  document.getElementById("dropdown-content").classList.remove("show");
  document.getElementById("location-dropdown-content").classList.remove("show");
}
window.onclick = function (event) {
  if (
    !event.target.matches(".user-icon") &&
    !event.target.matches(".user-text") &&
    !event.target.matches(".dashboard-dropbtn")

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