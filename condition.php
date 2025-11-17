<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
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
            padding: 1rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
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
    </style>
</head>
<body>

    <header>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <h1>Terms & Conditions</h1>
    </header>

    <main>
        <p id="description" class="fade-in">
            <h1>1. Introduction</h1>
            These Terms & Conditions govern the use of The Future Of Banking. By accessing or using the system, users agree to comply with these terms.
        </p>

        <h1 class="fade-in">2. User Responsibilities</h1>
        <p class="fade-in">
            - Users must provide accurate and updated personal and financial information. <br>
            - Account credentials (username, password, PIN) must be kept secure and confidential. <br>
            - Unauthorized access, fraud, or system abuse is strictly prohibited.
        </p>

        <h1 class="fade-in">3. Account Management</h1>
        <p class="fade-in">
            - Users can open, manage, and close accounts based on the bank’s policies. <br>
            - Transactions and account activities will be recorded and monitored. <br>
            - The bank reserves the right to suspend or terminate accounts for violations.
        </p>

        <h1 class="fade-in">4. Transactions & Payments</h1>
        <p class="fade-in">
            - Users can deposit, withdraw, transfer funds, and make payments. <br>
            - The bank is not responsible for incorrect transactions due to user errors. <br>
            - Transaction limits and fees may apply.
        </p>

        <h1 class="fade-in">5. Security & Privacy</h1>
        <p class="fade-in">
            - The system implements encryption and security measures. <br>
            - Users must report suspicious activities immediately. <br>
            - The bank may share data with third parties as per regulations.
        </p>

        <h1 class="fade-in">6. Liability & Disclaimers</h1>
        <p class="fade-in">
            - The bank is not liable for losses due to hacking, negligence, or system failures. <br>
            - The system may experience downtime due to maintenance. <br>
            - The bank does not guarantee uninterrupted access.
        </p>

        <button onclick="updateMessage()">Update Message</button>
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
