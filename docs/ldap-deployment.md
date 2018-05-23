Portal LDAP Deployment
======================

*See aditional documentation for troubleshooting a deployment(https://github.com/Adldap2/Adldap2-Laravel/blob/master/docs/quick-start.md)*

Step 0
---
Update .env file with:
```
ADLDAP_BASEDN=dc=corp,dc=ad,dc=ctc
ADLDAP_CONTROLLERS=corp.ad.ctc
ADLDAP_ADMIN_USERNAME=corp\fusert2.corp
ADLDAP_ADMIN_PASSWORD=P$94Pun$
ADLDAP_PASSWORD_SYNC=true
```

Step 1 
---

* Deploy as usual with Catapult - this will run the migration
* Make sure the form seeder classes in the DatabaseSeeder.php file are uncommented
* Run the seeder 
    * `php artisan db:seed`
* Run the migration for the unique usernames field
    * `pa migrate --path database/migrations/unique_usernames` 

Step 2
---
Run these SQL queries against these tables. Make sure the role ids for the form administration are 9, 10 and 11. Otherwise, adjust the SQL queries below.

**form_role**
```
INSERT INTO `form_role` (`id`, `form_id`, `role_id`, `created_at`, `updated_at`)
VALUES
	(3,1,9,NULL,NULL),
	(4,1,10,NULL,NULL);
```
**form_role_permission**
```
INSERT INTO `form_role_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`)
VALUES
	(1,9,1,NULL,NULL),
	(2,9,2,NULL,NULL),
	(3,9,3,NULL,NULL),
	(4,9,4,NULL,NULL),
	(5,9,5,NULL,NULL),
	(6,10,1,NULL,NULL),
	(7,10,2,NULL,NULL),
	(8,10,3,NULL,NULL),
	(9,10,4,NULL,NULL),
	(10,10,5,NULL,NULL),
	(11,11,5,NULL,NULL);
```
**form_role_hiearchy**
```
INSERT INTO `form_role_hierarchy` (`id`, `manager_role_id`, `employee_role_id`, `created_at`, `updated_at`)
VALUES
	(1,9,10,NULL,NULL),
	(2,9,11,NULL,NULL),
	(3,10,11,NULL,NULL);
```
Step 3
---
* Create the form component from the admin
    * Users and Groups > components > add new
* Assign to admin view

Step 4
---
* Create a form admin user using the admin/admin account

