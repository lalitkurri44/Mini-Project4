require('dotenv').config();
const express = require('express');
const stripe = require('stripe')(process.env.STRIPE_KEY);
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
app.use(cors());
app.use(bodyParser.json());

let DOMAIN = process.env.DOMAIN;

// Create Stripe checkout session
app.post('/stripe-checkout', async (req, res) => {
    try {
        const session = await stripe.checkout.sessions.create({
            payment_method_types: ["card", "upi"],
            mode: "payment",
            success_url: `${DOMAIN}/success.html`,
            cancel_url: `${DOMAIN}/index.html?payment_fail=true`,
            line_items: [
                {
                    price_data: {
                        currency: "inr",
                        product_data: {
                            name: "10 Rupees Payment",
                            description: "Test payment of ₹10",
                        },
                        unit_amount: 1000, // 10 INR in paise
                    },
                    quantity: 1,
                }
            ],
        });

        res.json({ url: session.url });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
});

// Start Server
app.listen(3000, () => {
    console.log("Server running on http://localhost:3000");
});
