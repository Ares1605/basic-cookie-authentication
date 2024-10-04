# User Authentication System

This repository contains a simple yet effective user authentication system implemented in PHP. The core of this system is the `SessionManager` class, which handles session creation, validation, and management.

## Features

- Secure session management
- IP-based session validation
- Automatic session expiration
- File-based session storage

## Main Components

### SessionManager

The `SessionManager` class is the heart of this authentication system. It provides the following key functionalities:

- Session creation
- Session validation
- IP-based security check
- Automatic cleaning of expired sessions

## Setup

1. Ensure you have PHP installed on your system.
2. Clone this repository:
   ```
   git clone https://github.com/your-username/user-authentication.git
   ```
3. Install dependencies:
   ```
   composer install
   ```
4. Set up your environment variables:
   - Create a `.env` file in the root directory
   - Add the following line, replacing `/path/to/secure/directory/` with your actual secure directory path:
     ```
     SECURE_DIRECTORY=/path/to/secure/directory/
     ```

## Usage

To use the SessionManager in your PHP scripts:

1. Include the necessary files:
   ```php
   require_once __DIR__ . '/vendor/autoload.php';
   require_once __DIR__ . '/Env.php';
   require_once __DIR__ . '/SessionManager.php';
   ```

2. Create a new session:
   ```php
   $session_id = SessionManager::create_session();
   ```

3. Validate an existing session:
   ```php
   $sessionManager = new SessionManager();
   $sessionManager->validate_session();
   ```

## Security Considerations

- Sessions are stored in a text file. Ensure the `SECURE_DIRECTORY` is properly configured and protected.
- The system uses IP-based validation. Be aware of potential issues with users behind proxies or VPNs.
- Session IDs are generated using `random_bytes()` for cryptographic security.
