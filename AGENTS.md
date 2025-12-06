# Agent Guidelines for Yoga App

## 🚫 RESTRICTIONS

### DO NOT Create These Files (Unless Explicitly Requested):
- ❌ Documentation files (*.md, *.txt) except when asked
- ❌ README updates
- ❌ CHANGELOG files
- ❌ Guide/tutorial files
- ❌ Summary files
- ❌ Any file not directly related to the task

### DO NOT Modify These Files (Unless Explicitly Requested):
- ❌ README.md
- ❌ composer.json (unless dependency changes needed)
- ❌ package.json (unless dependency changes needed)
- ❌ .env files
- ❌ Configuration files in /config (unless task requires it)

## ✅ ALLOWED ACTIONS

### Primary Tasks:
- ✅ Create/modify Laravel views (.blade.php)
- ✅ Create/modify Controllers
- ✅ Create/modify Models
- ✅ Create/modify Routes
- ✅ Create/modify Components
- ✅ Update api.yml when API changes are needed
- ✅ Create migrations when database changes needed

### Code Style:
- Use Tailwind CSS for styling
- Follow Laravel conventions
- Keep components reusable
- Write clean, readable code

## 📝 DOCUMENTATION POLICY

**Default: NO documentation files**

Only create documentation when:
1. User explicitly asks: "create documentation"
2. User explicitly asks: "update README"
3. User explicitly asks: "write guide"

Otherwise, focus on CODE IMPLEMENTATION only.

## 🎯 WORKFLOW

1. **Understand the task** - Read user request carefully
2. **Plan the changes** - Identify which files need modification
3. **Implement** - Make code changes only
4. **Test** - Verify changes work (if applicable)
5. **Report** - Briefly explain what was done

## 💬 RESPONSE FORMAT

Keep responses concise:
- Brief explanation of changes made
- List of files modified/created
- Any important notes for the user
- Ask if anything else is needed

**DO NOT include:**
- Lengthy documentation
- Tutorial-style explanations (unless asked)
- Multiple summary files

## 🔍 SPECIAL CASES

### API Changes:
- Update api.yml with endpoint definitions
- No separate API documentation file

### New Features:
- Implement the feature
- Add inline code comments if complex
- No separate feature documentation

### Bug Fixes:
- Fix the code
- Briefly explain the fix
- No changelog entry

## 📂 PROJECT STRUCTURE AWARENESS

```
app/
├── Http/Controllers/    # Controllers here
├── Models/             # Models here
└── View/Components/    # Components here

resources/views/
├── layouts/            # Layouts here
├── components/         # Blade components here
└── [feature]/          # Feature views here

routes/
├── web.php            # Web routes
└── api.php            # API routes

api.yml                # OpenAPI specification
```

## 📐 CODE STANDARDS

### Views (Blade Templates):
- Use `<x-admin-layout>` for admin pages
- Tailwind CSS only (no custom CSS)
- Responsive design (mobile-first)
- Include validation error displays with `@error` directive
- Use SVG icons from Heroicons

**Example:**
```blade
<x-admin-layout>
    <x-slot name="title">Page Title</x-slot>
    
    <div class="max-w-7xl mx-auto">
        <!-- Content here -->
    </div>
</x-admin-layout>
```

### Controllers:
- Validate all input using `$request->validate()`
- Return consistent JSON for API endpoints
- Handle errors gracefully with try-catch when needed
- Use Eloquent models, avoid raw queries

**API Response Format:**
```php
// Success
return response()->json([
    'success' => true,
    'data' => $data,
    'message' => 'Optional message'
], 200);

// Error
return response()->json([
    'success' => false,
    'message' => 'Error message'
], 4xx);
```

### API Endpoints:
- Follow REST conventions (GET, POST, PUT, DELETE)
- Update api.yml when adding/modifying endpoints
- Use standard HTTP status codes
- Include pagination for list endpoints

### Forms:
- Always include `@csrf` token
- Show validation errors with `@error('field')`
- Use consistent styling with existing forms
- Add `required` attribute for required fields

## 🚀 EFFICIENCY TIPS

- Make changes in parallel when possible
- Test only relevant parts
- Don't create temporary files unless necessary
- Clean up any temporary files created during development

## ⚡ QUICK REFERENCE

| User Request | Action to Take |
|--------------|----------------|
| "Add sidebar" | Create sidebar.blade.php + necessary code only |
| "Update API" | Update api.yml + controllers/routes if needed |
| "Fix bug in dashboard" | Fix the bug in relevant file(s) |
| "Add new feature" | Implement code, no documentation |
| "Document the API" | NOW you can create API documentation |
| "Update README" | NOW you can update README.md |

## 🎨 UI/UX STANDARDS

### Color Scheme:
- Primary: `blue-600`, `blue-700` (hover)
- Success: `green-600`, `green-700` (hover)
- Warning: `yellow-500`, `yellow-600` (hover)
- Danger: `red-600`, `red-700` (hover)
- Neutral: `gray-50` to `gray-900`

### Spacing:
- Container padding: `p-6` or `p-8`
- Section gaps: `space-y-6`
- Button padding: `px-4 py-2` or `px-6 py-3`

### Typography:
- Headings: `text-2xl font-bold` or `text-xl font-semibold`
- Body: `text-sm` or `text-base`
- Labels: `text-sm font-medium`

---

**Remember:** Code first, documentation only when explicitly requested.
