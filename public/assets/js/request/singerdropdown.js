function toggleDropdown() {
    const dropdown = document.getElementById("singerDropdown");
    dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
  }
  
  function viewProfile(singerId) {
    // Add functionality to view the profile of the singer with ID `singerId`
    alert(`Viewing profile for Singer ID: ${singerId}`);
  }
  
  function requestSinger(singerId) {
    // Add functionality to request the singer with ID `singerId` for the event
    alert(`Request sent to Singer ID: ${singerId}`);
  }
  