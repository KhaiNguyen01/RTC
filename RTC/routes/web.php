<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'student_routing_controller@home');
Route::get('/my','student_routing_controller@my');
Route::get('/login', 'student_routing_controller@loginview');
Route::post('/studentlogin', 'student_routing_controller@login');
Route::get('/logout', 'student_routing_controller@logout');


Route::post('/students/all_courses','student_data_controller@getAllCourses');
Route::post('/students/my_courses','student_data_controller@getCoursesByStudent');
Route::post('/students/rate','student_data_controller@rate');
Route::get('/my/{class_id}', 'student_routing_controller@classrateview');
Route::post('/my/changepassword', 'student_data_controller@changePassword');

Route::get('/teacher','teacher_routing_controller@teacherview');
Route::get('teacher/logout', 'teacher_routing_controller@logout');
Route::get('/teacher/{class_id}','teacher_routing_controller@classview');
Route::post('/teacherlogin', 'teacher_routing_controller@login');
Route::post('/teacher/changepassword', 'teacher_data_controller@changePassword');

Route::post('/teacher/all_courses','teacher_data_controller@getAllCourses');
Route::post('/teacher/class_data','teacher_data_controller@getClassData');

Route::get('/admin', 'admin_routing_controller@do_the_routing');
Route::get('/admin/{path?}', 'admin_routing_controller@check_path');
Route::post('/admin/dashboard_data','admin_data_controller@dashboard');
Route::post('/adminlogin', 'admin_routing_controller@admin_login');
Route::get('/adminlogout', 'admin_routing_controller@admin_logout');

Route::post('/admin/teachers/list','admin_data_controller@get_teachers');
Route::post('/admin/teachers/excel','admin_data_controller@insert_teachers_by_excel');
Route::post('/admin/teachers/insert','admin_data_controller@insert_teacher');
Route::post('/admin/teachers/edit','admin_data_controller@edit_teacher');
Route::post('/admin/teachers/delete','admin_data_controller@delete_teacher');

Route::post('/admin/students/list','admin_data_controller@get_students');
Route::post('/admin/students/excel','admin_data_controller@insert_students_by_excel');
Route::post('/admin/students/insert','admin_data_controller@insert_student');
Route::post('/admin/students/edit','admin_data_controller@edit_student');
Route::post('/admin/students/delete','admin_data_controller@delete_student');

Route::post('/admin/schemas/list','admin_data_controller@get_schemas');
Route::post('/admin/schemas/insert','admin_data_controller@insert_schema');
Route::post('/admin/schemas/edit','admin_data_controller@edit_schema');
Route::post('/admin/schemas/delete','admin_data_controller@delete_schema');

Route::post('/admin/classes/list','admin_data_controller@get_classes_data');
Route::post('/admin/classes/insert','admin_data_controller@insert_classes');
Route::post('/admin/classes/delete','admin_data_controller@delete_classes');
Route::post('/admin/classes/list_student','admin_data_controller@list_student_by_class');

Route::post('/admin/surveys/get_results','admin_data_controller@get_survey_results');
