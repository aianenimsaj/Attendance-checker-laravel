function showSection(sectionId) {
    document.querySelectorAll("section").forEach(sec => {
        sec.style.display = "none";
    });
    document.getElementById(sectionId).style.display = "block";
}

// Example login simulation
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const id = document.getElementById("idnumber").value;
            const role = document.getElementById("role").value;
            
            if (id && role) {
                document.getElementById("user-name").innerText = role.toUpperCase();
                document.getElementById("user-id").innerText = id;
                showSection("dashboard-section");
            } else {
                document.getElementById("login-error").innerText = "Invalid login!";
            }
        });
    }
});
