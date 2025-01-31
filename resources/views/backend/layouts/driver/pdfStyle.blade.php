<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f7f7f7;
    }

    .container {
        max-width: 900px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 10px;
    }

    h2 {
        margin-top: 20px;
        font-size: 18px;
        border-bottom: 2px solid #ccc;
        padding-bottom: 5px;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="time"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .inspection-category {
        margin-top: 20px;
    }

    .inspection-category ul {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .inspection-category ul li {
        display: flex;
        align-items: center;
    }

    .inspection-category ul li input {
        margin-right: 10px;
    }

    .row {
        display: flex;
        gap: 20px;
    }

    .row > div {
        flex: 1;
    }

    button {
        margin-top: 20px;
        padding: 10px 15px;
        border: none;
        background-color: #007BFF;
        color: white;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>