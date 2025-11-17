<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        /* Header */
        header {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
        }

        /* Navigation */
        .nav-item {
            list-style: none;
            text-align: center;
            margin: 10px 0;
        }
        .nav-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            background: #ff9800;
            border-radius: 5px;
            transition: 0.3s;
        }
        .nav-link:hover {
            background: #e68900;
        }

        /* Main Content */
        main {
            background: rgba(0, 0, 0, 0.7);
            padding: 2rem;
            text-align: left;
            border-radius: 10px;
            max-width: 800px;
            margin: 50px auto;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
        }

        /* Buttons */
        button {
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            cursor: pointer;
            margin-top: 1rem;
            border-radius: 5px;
            font-size: 1rem;
            transition: 0.3s;
        }
        button:hover {
            background-color: #e68900;
        }

        /* Headings */
        h1 {
            color: #ffcc00;
            border-bottom: 2px solid #ffcc00;
            padding-bottom: 5px;
        }

        /* Paragraphs */
        p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Smooth Fade-in Effect */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s ease-in-out;
        }

        .fade-in.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Image */
        .img-container {
            text-align: center;
            margin: 20px 0;
        }
        .img-container img {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

    <header>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <h1>About Us</h1>
    </header>

 

    <main>
        <h1 class="fade-in">1. Introduction</h1>
        <p class="fade-in">
            <strong>1.1 Project Overview:</strong>  
            This project is a Banking System that allows users to create accounts, deposit and withdraw money, check balances, and perform other banking operations securely.
        </p>

        <p class="fade-in">
            <strong>1.2 Purpose:</strong>  
            The system aims to provide a secure, user-friendly, and efficient banking experience. It helps users manage their finances online while ensuring high security and reliability.
        </p>

        <p class="fade-in">
            <strong>1.3 Scope:</strong>  
            - User account creation and management  
            - Secure login and authentication  
            - Fund transfer between accounts  
            - Transaction history tracking  
            - Interest calculation (for savings accounts)  
            - Loan and credit management  
            - Admin dashboard for monitoring  
        </p>

        <h1 class="fade-in">2. System Requirements</h1>

        <p class="fade-in">
            <strong>2.1 Functional Requirements:</strong>  
            - User Registration & Login  
            - Account Management (Savings, Current, Fixed Deposit)  
            - Money Transactions (Deposit, Withdrawal, Transfer)  
            - Loan Application & Approval  
            - Transaction History & Statements  
            - Admin Management (User Monitoring, Fraud Detection)  
        </p>

        <p class="fade-in">
            <strong>2.2 Non-Functional Requirements:</strong>  
            - Security (Encryption, OTP-based authentication)  
            - Performance (Fast transactions, database optimization)  
            - Scalability (Multiple users can operate simultaneously)  
            - Compliance (Following banking regulations like KYC, AML)  
        </p>

    </main>

    <script>
        // JavaScript functionality to update message
        function updateMessage() {
            const description = document.getElementById('description');
            description.innerText = "Our mission is to provide the best products and services for our customers. Thank you for choosing us!";
        }

        // Smooth fade-in animation
        document.addEventListener("DOMContentLoaded", function() {
            let elements = document.querySelectorAll(".fade-in");
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add("active");
                }, index * 200);
            });
        });
    </script>

</body>
</html>
