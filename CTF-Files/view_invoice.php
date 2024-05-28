<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موقع ال IDOR</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url('https://theintercept.com/wp-content/uploads/2016/08/Pokemon_theintercept_01.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .container {
            padding: 20px;
            border-radius: 10px;
        }

        button {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkgreen;
        }

        .error {
            background-color: red;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    $invoices = array();

    $customer_names = array(
        'John Doe',
        'Jane Smith',
        'David Johnson',
        'Emily Brown',
        'Michael Williams',
        'Sarah Jones',
        'Robert Miller',
        'admin',
        'Daniel Garcia',
        'Lisa Wilson',
        'Matthew Taylor',
        'Jennifer Martinez',
        'Christopher Anderson',
        'Laura Thomas',
        'Brian Hernandez'
    );

    for ($i = 1; $i <= 15; $i++) {
        $customer_id = md5($i);
        $invoices[$customer_id] = array(
            'invoice_number' => $i,
            'customer_name' => $customer_names[$i - 1],
            'amount' => 100.00,
            'due_date' => '2024-05-15',
            'hint' => ($i == 8) ? "/GGHTeam/GG/flag/" : ""
        );
    }

    if(isset($_GET['id'])) {
        $encrypted_invoice_number = $_GET['id'];
        if(isset($invoices[$encrypted_invoice_number])) {
            $invoice = $invoices[$encrypted_invoice_number];
            echo "<h2>Invoice Details</h2>";
            echo "<p>Encrypted Invoice Number: " . $encrypted_invoice_number . "</p>";
            echo "<p>Customer Name: " . $invoice['customer_name'] . "</p>";
            echo "<p>Amount: $" . $invoice['amount'] . "</p>";
            echo "<p>Due Date: " . $invoice['due_date'] . "</p>";
            if(!empty($invoice['hint'])) {
                echo "<p>Hint: " . $invoice['hint'] . "</p>";
            }
        } else {
            echo "<h2 class='error'>Error: Failed To Enter Invoice Number :(</h2>";
        }
    } else {
        echo "<h2 class='error'>Error: Invoice number not specified!</h2>";
    }
    ?>
</div>

</body>
</html>
