# TriTrack - Daily Activity Tracker

A web-based daily activity tracking application built with pure PHP MVC architecture and vanilla JavaScript.

## Author
**franzxml**

## Features

### Core Functionality
- **Three Independent Timers**: Track time for Honkai: Star Rail, GTA V, and Coding
- **Real-time Tracking**: Start, pause, and stop timers independently
- **Progress Visualization**: Visual progress bars showing completion against daily targets
- **Session Notes**: Add notes to document what you accomplished in each session
- **Browser Notifications**: Get alerts when you reach your time limits

### Analytics & History
- **Daily Summary**: View total time spent and session breakdown for today
- **Weekly History**: Track patterns over weeks with statistics
- **Activity Breakdown**: See time distribution across all activities

### Customization
- **Adjustable Targets**: Set custom time goals for each activity (hours/minutes)
- **Notification Settings**: Enable/disable time limit and switch reminders
- **Data Persistence**: LocalStorage backup ensures no data loss on refresh

## Technology Stack

### Frontend
- HTML5
- CSS3 (Pure, no frameworks)
- JavaScript (Vanilla ES6+)

### Backend
- PHP 8+ (Pure MVC, no frameworks)
- MySQL (via PDO)

### Environment
- Laragon (Local Development)
- Apache/Nginx
- phpMyAdmin

## Installation

### Prerequisites
- Laragon installed
- PHP 8.0 or higher
- MySQL 5.7 or higher

### Setup Steps

1. **Clone/Create Project Directory**
```bash
cd C:/laragon/www
mkdir tritrack && cd tritrack
```

2. **Initialize Database**
- Open phpMyAdmin
- Run the SQL scripts from database initialization

3. **Configure Virtual Host**
- Laragon will auto-detect `tritrack` folder
- Access via: `tritrack.test`

4. **Set Permissions** (if needed)
```bash
chmod -R 755 storage/
```

## Project Structure
```
tritrack/
├── app/
│   ├── controllers/      # Application controllers
│   ├── models/           # Database models
│   ├── views/            # View templates
│   ├── core/             # Core MVC classes
│   ├── config/           # Configuration files
│   └── helpers/          # Helper utilities
├── public/               # Public assets
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── assets/           # Images, fonts
└── storage/              # Logs, cache, sessions
```

## Database Schema

### Tables
1. **activities** - Activity definitions (Honkai, GTA, Coding)
2. **sessions** - Individual tracking sessions with notes
3. **daily_summaries** - Aggregated daily statistics

## Usage

### Starting a Timer
1. Navigate to dashboard (`tritrack.test`)
2. Click "Start" on any activity card
3. Timer begins counting automatically

### Stopping a Session
1. Click "Stop" on running timer
2. Add optional session notes in modal
3. Data saves to database automatically

### Viewing Statistics
1. Click "View Statistics" from dashboard
2. See today's breakdown and session history

### Adjusting Settings
1. Click "Settings" from dashboard
2. Modify daily time targets
3. Toggle notification preferences

## API Endpoints

### Sessions
- `POST /ApiController/saveSession` - Save timer session
- `GET /ApiController/getTodaySessions` - Get today's sessions

### Activities
- `GET /ApiController/getActivities` - Get all activities
- `POST /ApiController/updateTarget` - Update activity target

### Analytics
- `GET /ApiController/getWeeklySummary` - Get weekly statistics

## Browser Support
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## License
Private project by franzxml

## Version
1.0.0
