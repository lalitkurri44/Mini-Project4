document.getElementById("pay-btn").addEventListener("click", async () => {
    try {
        let response = await fetch("http://localhost:3000/stripe-checkout", { method: "POST" });
        let data = await response.json();
        if (data.url) {
            window.location.href = data.url;
        } else {
            document.getElementById("message").textContent = "Payment failed!";
        }
    } catch (error) {
        console.error("Error:", error);
    }
});
