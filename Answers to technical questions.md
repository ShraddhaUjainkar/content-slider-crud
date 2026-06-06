# Answers to Technical Questions

## How long did you spend on the coding test? What would you add to your solution if you had more time?

I spent around 6 to 8 hours building the solution, including the database schema, PHP/PDO backend, admin CRUD screens, image upload handling, responsive frontend, seed data, and documentation.

If I had more time, I would add:

- Admin authentication with roles and password hashing.
- Drag-and-drop sorting for tabs and slides.
- Server-side image resizing and thumbnail generation.
- Unit or integration tests for models and upload validation.
- Better admin form validation with inline field errors.
- A deployment-ready `.env` configuration instead of hard-coded database constants.
- Audit fields such as `created_at`, `updated_at`, and `created_by`.
- A richer preview mode in the admin panel before publishing changes.

## How would you track down a performance issue in production? Have you ever had to do this?

I would start by confirming the issue with real production signals instead of guessing. First, I would check application logs, server metrics, database metrics, slow query logs, error rates, response times, CPU, memory, disk I/O, and network usage. Then I would identify whether the bottleneck is coming from PHP code, database queries, frontend assets, third-party services, or infrastructure.

For a PHP and MySQL application, I would specifically check:

- Slow MySQL queries using the slow query log or `EXPLAIN`.
- Missing indexes on frequently filtered or sorted columns.
- N+1 query patterns.
- Large image or asset payloads.
- Uncached repeated database reads.
- PHP errors, warnings, or memory spikes.
- External API calls blocking page rendering.

After finding a likely cause, I would reproduce it in staging or with safe production diagnostics, make one focused fix, deploy it carefully, and compare metrics before and after the change.

Yes, I have worked through performance-style debugging before. Common examples include reducing unnecessary database queries, adding proper indexes, optimizing image sizes, and improving frontend load time by removing blocking or oversized assets.

## Please describe yourself using JSON.

```json
{
  "name": "Shraddha",
  "role": "Full Stack Developer",
  "primary_stack": [
    "PHP",
    "MySQL",
    "JavaScript",
    "Bootstrap",
    "HTML",
    "CSS"
  ],
  "strengths": [
    "clean code",
    "problem solving",
    "responsive UI implementation",
    "database-driven application development",
    "attention to detail"
  ],
  "working_style": {
    "approach": "practical and organized",
    "focus": "building reliable, user-friendly solutions",
    "communication": "clear and collaborative"
  },
  "values": [
    "quality",
    "learning",
    "ownership",
    "continuous improvement"
  ],
  "current_goal": "to keep improving as a full stack developer and contribute to meaningful web applications"
}
```
