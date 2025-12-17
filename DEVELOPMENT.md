# TriTrack Development Notes

## Development Guidelines

### Code Organization
- Maximum 50 lines per file
- Maximum 5 files per folder
- Use sub-folders for organization beyond limits

### Naming Conventions
- Variables/Functions: camelCase
- Classes: PascalCase
- Files/CSS: kebab-case
- Language: English only

### Documentation
- PHPDoc for all PHP functions/classes
- JSDoc for JavaScript functions
- Inline comments for complex logic

## File Structure Rules

### Controllers
- One controller per entity
- Extend base Controller class
- Keep methods focused and single-purpose

### Models
- One model per database table
- Use prepared statements always
- Return arrays or false

### Views
- Use output buffering for content
- Include layout at end
- Pass data via extract()

### JavaScript Components
- One class per file
- Use modern ES6+ syntax
- Initialize on DOMContentLoaded

### CSS Components
- Component-specific styles only
- No global styles in components
- Use BEM-like naming

## Database Guidelines

### Queries
- Always use prepared statements
- Bind parameters explicitly
- Handle errors gracefully

### Transactions
- Use for multi-table operations
- Always rollback on error
- Commit only on success

## Testing Checklist

### Frontend
- [ ] All timers start/pause/stop correctly
- [ ] Progress bars update in real-time
- [ ] Modal shows on stop with notes
- [ ] LocalStorage persists across refresh
- [ ] Notifications trigger at time limits

### Backend
- [ ] Sessions save to database
- [ ] Activities retrieve correctly
- [ ] Targets update properly
- [ ] Daily summaries calculate accurately
- [ ] API returns proper JSON

### Integration
- [ ] Timer data syncs with database
- [ ] Statistics display accurately
- [ ] History shows weekly data
- [ ] Settings persist correctly
- [ ] 404 page shows for invalid routes

## Common Issues & Solutions

### Issue: Timer doesn't persist
**Solution**: Check localStorage keys match StorageHelper format

### Issue: API returns 404
**Solution**: Verify .htaccess rules and controller names

### Issue: Database connection fails
**Solution**: Check config/database.php credentials

### Issue: Notifications don't show
**Solution**: Ensure browser permissions granted

## Future Enhancements
- Export data to CSV/PDF
- Multi-user support with authentication
- Mobile app version
- Cloud sync capability
- Customizable activity colors
- Weekly/monthly reports