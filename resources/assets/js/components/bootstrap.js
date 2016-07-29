
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Components
 |--------------------------------------------------------------------------
 |
 | Here we will load the Spark components which makes up the core client
 | application. This is also a convenient spot for you to load all of
 | your components that you write while building your applications.
 */

require('./../spark-components/bootstrap');

require('./home');

// Load the new Vue component...
require('./settings/profile/update-profile-details');

require('./company/projects/create-project');
require('./company/projects/update-project');
require('./company/projects/project-image');
require('./company/projects/projects-list');
require('./company/projects/project-steps');

require('./projects/project-subscribe');
require('./projects/project-unsubscribe');
require('./projects/favorite');

require('./users/follow');

require('./activity-feed');
require('./projects-feed');

require('./dashboard/daily-feed');
require('./dashboard/subscribed-projects');

require('./settings/update-analytics-settings');