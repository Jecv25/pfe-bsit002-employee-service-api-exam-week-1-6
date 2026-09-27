# Employee Management API

## API Title

Employee Management API

## Base URL

http://127.0.0.1:8000/api/v1

## Resources

- employees
- departments

## Endpoints

| Method | Endpoint | Purpose |
|---|---|---|
| GET | /employees | View all employees |
| GET | /employees/{id} | View one employee |
| POST | /employees | Add an employee |
| PUT | /employees/{id} | Update an employee |
| DELETE | /employees/{id} | Delete an employee |
| GET | /employees?search=juan | Search employee by name |
| GET | /employees?department=IT | Filter employees by department |

## Sample Request Body

```json
{
    "first_name": "Juan",
    "last_name": "Dela Cruz",
    "email": "juan@example.com",
    "department": "IT",
    "position": "Programmer"
}


This demonstrates what the client would send when creating an employee.

---

# STEP 10 — Add Your Response Body

Under it, add:

```markdown
## Sample Response Body

```json
{
    "id": 1,
    "first_name": "Juan",
    "last_name": "Dela Cruz",
    "email": "juan@example.com",
    "department": "IT",
    "position": "Programmer",
    "created_at": "2026-08-04T10:00:00Z"
}


This demonstrates what the API could return after processing the request.

---

# STEP 11 — Add Your Status Code Plan

Your assignment specifically requires a **status code plan**.

Add:

```markdown
## Status Code Plan

| Status Code | Meaning | Usage |
|---|---|---|
| 200 | OK | Request completed successfully |
| 201 | Created | Employee was successfully created |
| 400 | Bad Request | Request contains invalid information |
| 401 | Unauthorized | Authentication is required |
| 403 | Forbidden | User does not have permission |
| 404 | Not Found | Employee does not exist |
| 422 | Validation Error | Submitted data failed validation |
| 500 | Server Error | Unexpected server-side error |

## API Versioning

The API uses version 1 through the `/api/v1` URL prefix.

Example:

GET /api/v1/employees

Future versions could use:

GET /api/v2/employees

## REST Design Principles

The API follows RESTful conventions by:

- Using nouns for resource names.
- Using plural resource names.
- Using HTTP methods to describe operations.
- Using HTTP status codes to communicate results.
- Using resource IDs to access individual employees.
- Using query parameters for searching and filtering.