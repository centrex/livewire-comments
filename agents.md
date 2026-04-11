# agents.md

## Agent Guidance — livewire-comments

### Package Purpose
Livewire-powered comment threads for any Laravel model. Drop in `<livewire:livewire-comments :model="$post" />` and any model using the `HasComments` trait becomes commentable.

### Before Making Changes
- Read `src/Models/` — the `Comment` model and its fields (commentable polymorphic, author, content, parent for nesting)
- Read `src/Traits/HasComments.php` — the trait added to host models
- Read `src/Policies/` — authorization for create/edit/delete
- Read `src/Scopes/` — query scopes (approved, pending, by-author, etc.)
- Check `resources/views/livewire/` — Blade templates for the comment UI

### Common Tasks

**Adding nested/threaded comments**
1. Add a nullable `parent_id` column referencing the `comments` table
2. Add a `replies()` hasMany relation on `Comment`
3. Update the Livewire component to render nested replies recursively (careful with depth limits)
4. Add a `depth` config option — prevent infinite nesting

**Adding comment moderation**
1. Add a `status` column (e.g., `pending`, `approved`, `rejected`) with a default
2. Add `approved()` and `pending()` scopes in `src/Scopes/`
3. Update the Livewire component to filter by status based on user role
4. Use the Policy to check who can approve/reject comments

**Adding reactions/likes to comments**
- Keep reactions out of this package — they belong in a separate package or host app
- Expose a slot or event in the Livewire component for host apps to inject reaction UI

**Updating Blade views**
- Views are published to host apps — be careful about breaking published view structures
- New slots or variables must be backwards compatible
- Add a CHANGELOG note for any view changes

### Testing
```sh
composer test:unit        # pest
composer test:types       # phpstan
composer test:lint        # pint
```

Test polymorphic scoping — comments from one model type must not appear on another:
```php
$post->addComment($user, 'Hello from post');
$video->addComment($user, 'Hello from video');
expect($post->comments()->count())->toBe(1);
expect($video->comments()->count())->toBe(1);
```

### Safe Operations
- Adding new Livewire component props
- Adding model scopes
- Adding nullable migration columns
- Adding policy methods

### Risky Operations — Confirm Before Doing
- Changing polymorphic column names (`commentable_type`, `commentable_id`)
- Changing trait method names on `HasComments` (breaks host app code)
- Restructuring Blade view variable names (breaks published views in host apps)

### Do Not
- Hard-delete comments that have replies — soft delete or orphan-protect
- Expose raw HTML in comment content without sanitization
- Skip `declare(strict_types=1)` in any new file
