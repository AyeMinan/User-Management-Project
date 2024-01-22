<x-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center; /* Center text content */
        }

        h1 {
            margin-top: 20px;
        }

        p {
            margin: 20px;
        }

        button {
            margin-top: 20px;
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            width: 100px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #555;
        }
    </style>
<h1>Welcome to User Management App</h1>
<p>Welcome to our User Management Platform, the central hub for efficiently handling user accounts and access control. Our platform provides a seamless experience for managing users within your system, ensuring security and ease of administration. With intuitive features such as user authentication, registration, and personalized access controls, you can effortlessly tailor user permissions to meet the unique needs of your application. Whether you are a small business or a large enterprise, our User Management Platform empowers you to maintain a secure and organized user environment. Join us in streamlining user administration, enhancing security, and optimizing your workflow with our comprehensive user management solution.</p>
<a href="{{route('main.index')}}"> <button class="btn btn-primary">Start</button></a>

</x-layout>
