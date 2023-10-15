# Laravel API Implementation with SignNow

This Laravel project demonstrates the implementation of SignNow's electronic signature API. SignNow is a powerful e-signature platform that allows you to manage and automate document signing workflows.

## Getting Started

Follow these steps to set up the project:

1. **Clone the Repository:**

2. **Install Dependencies:**

3. **Environment Variables:**

Create a `.env` file in the project root and configure the following variables:

`SIGNNOW_CLIENT_ID=your-signnow-client-id` <br>
`SIGNNOW_SECRET_ID=your-signnow-client-secret` <br>
`SIGNNOW_BASIC_TOKEN=your-signnow-basic-token`<br>
`SIGNNOW_BASE_URL=your-signnow-base-url` <br>

4. **Start the Application:**

`php artisan serve`


The Laravel application should now be running and accessible via `http://127.0.0.1:8000`.

## SignNow API Implementation

- The SignNow API implementation is done in the application's controllers and routes. You can find specific routes and controller methods that interact with SignNow's API to create, manage, and sign documents.

- Refer to SignNow's API documentation for detailed information on how to use the API: [SignNow API Documentation](https://docs.signnow.com/docs/signnow/YXBpOjQwMDY0MDM3-api-reference) <br> [Signnow PHP](https://github.com/signnow/SignNowPHPSDK)

- Ensure that you have obtained the required credentials (client ID, client secret, basic token, and base URL) from SignNow to configure your `.env` variables.

- This Laravel project serves as an example of how to integrate SignNow into your application. Customize it according to your specific requirements and document workflows.

## Contributing

If you have suggestions or improvements for this project, feel free to open issues and submit pull requests.




   

