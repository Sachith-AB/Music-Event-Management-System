document.addEventListener("DOMContentLoaded", () => {
  const sidebarMenu = document.getElementById("sidebarMenu");
  const currentUrl = window.location.href;

  // Function to set the active class based on the current URL
  const setActiveLink = () => {
      document.querySelectorAll(".menu-link").forEach(link => {
          if (link.href === currentUrl) {
              link.classList.add("active");
          } else {
              link.classList.remove("active");
          }
      });
  };

  // Initial active class setup
  setActiveLink();

  // Add click event to toggle 'active' class
  sidebarMenu.addEventListener("click", (event) => {
      if (event.target.tagName === "A") {
          document.querySelectorAll(".menu-link").forEach(link => link.classList.remove("active"));
          event.target.classList.add("active");
      }
  });

  // Update active link on page load
  window.addEventListener("load", setActiveLink);
});
