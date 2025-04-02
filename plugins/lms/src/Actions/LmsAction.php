<?php

namespace Mojahid\Lms\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Models\Role;

class LmsAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );
        
        $this->addAction(
            'juzaweb.setting.save',
            [$this, 'saveSetting']
        );
    }
    
    /**
     * Register configurations for LMS
     */
    public function registerConfigs(): void
    {
        HookAction::registerConfig(
            [
                // General store settings
                '_store_address1' => [
                    'label' => 'Store Address Line 1',
                    'type' => 'text',
                ],
                '_store_address2' => [
                    'label' => 'Store Address Line 2',
                    'type' => 'text',
                ],
                '_city' => [
                    'label' => 'City',
                    'type' => 'text',
                ],
                '_country' => [
                    'label' => 'Country',
                    'type' => 'select',
                ],
                '_zipcode' => [
                    'label' => 'Zipcode',
                    'type' => 'text',
                ],
                
                // Course settings
                'lms_default_course_status' => [
                    'label' => 'Default Course Status',
                    'type' => 'select',
                    'options' => [
                        'publish' => 'Published',
                        'draft' => 'Draft',
                        'pending' => 'Pending Review',
                    ],
                    'default' => 'draft',
                ],
                'lms_course_permalink_base' => [
                    'label' => 'Course Permalink Base',
                    'type' => 'text',
                    'default' => 'course',
                ],
                'lms_course_access_mode' => [
                    'label' => 'Default Course Access Mode',
                    'type' => 'select',
                    'options' => [
                        'open' => 'Open Access',
                        'paid' => 'Paid Access',
                        'restricted' => 'Restricted Access',
                    ],
                    'default' => 'open',
                ],
                'lms_course_display_mode' => [
                    'label' => 'Course Content Display',
                    'type' => 'select',
                    'options' => [
                        'all' => 'Show All Lessons',
                        'sequential' => 'Sequential Access',
                    ],
                    'default' => 'all',
                ],
                
                // Student settings
                'lms_student_registration' => [
                    'label' => 'Enable Student Registration',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                'lms_student_role' => [
                    'label' => 'Default Student Role',
                    'type' => 'select',
                    'options' => [
                        'subscriber' => 'Subscriber',
                        'customer' => 'Customer',
                    ],
                    'default' => 'subscriber',
                ],
                'lms_progress_tracking' => [
                    'label' => 'Enable Progress Tracking',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                'lms_auto_complete_lesson' => [
                    'label' => 'Auto-Complete Lessons',
                    'type' => 'checkbox',
                    'default' => 0,
                ],
                'lms_enable_reviews' => [
                    'label' => 'Enable Course Reviews',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                
                // Instructor settings
                'lms_instructor_application' => [
                    'label' => 'Allow Instructor Applications',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                'lms_instructor_commission' => [
                    'label' => 'Instructor Commission (%)',
                    'type' => 'number',
                    'default' => 70,
                ],
                'lms_auto_approve_instructor' => [
                    'label' => 'Auto-Approve Instructor Applications',
                    'type' => 'checkbox',
                    'default' => 0,
                ],
                
                // Certificate settings
                'lms_enable_certificates' => [
                    'label' => 'Enable Certificates',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                'lms_certificate_logo' => [
                    'label' => 'Certificate Logo',
                    'type' => 'image',
                ],
                'lms_certificate_signature' => [
                    'label' => 'Certificate Signature',
                    'type' => 'image',
                ],
                'lms_certificate_template' => [
                    'label' => 'Certificate Template',
                    'type' => 'select',
                    'options' => [
                        'default' => 'Default Template',
                        'professional' => 'Professional Template',
                        'minimal' => 'Minimal Template',
                    ],
                    'default' => 'default',
                ],
                
                // Email settings
                'lms_email_new_course' => [
                    'label' => 'New Course Notification',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                'lms_email_course_completion' => [
                    'label' => 'Course Completion Email',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                'lms_email_enrollment' => [
                    'label' => 'Enrollment Confirmation Email',
                    'type' => 'checkbox',
                    'default' => 1,
                ],
                
                // Page settings
                'lms_courses_page' => [
                    'label' => 'Courses Page',
                    'type' => 'select_page',
                ],
                'lms_my_courses_page' => [
                    'label' => 'My Courses Page',
                    'type' => 'select_page',
                ],
                'lms_checkout_page' => [
                    'label' => 'Checkout Page',
                    'type' => 'select_page',
                ],
                'lms_thank_you_page' => [
                    'label' => 'Thank You Page',
                    'type' => 'select_page',
                ],
                'lms_instructor_page' => [
                    'label' => 'Become Instructor Page',
                    'type' => 'select_page',
                ],
            ]
        );
    }
    
    /**
     * Handle saving LMS plugin settings
     */
    public function saveSetting($request): void
    {
        // General store settings
        set_config('_store_address1', $request->input('_store_address1'));
        set_config('_store_address2', $request->input('_store_address2'));
        set_config('_city', $request->input('_city'));
        set_config('_country', $request->input('_country'));
        set_config('_zipcode', $request->input('_zipcode'));
        
        // Course settings
        set_config('lms_default_course_status', $request->input('lms_default_course_status', 'draft'));
        set_config('lms_course_permalink_base', $request->input('lms_course_permalink_base', 'course'));
        set_config('lms_course_access_mode', $request->input('lms_course_access_mode', 'open'));
        set_config('lms_course_display_mode', $request->input('lms_course_display_mode', 'all'));
        
        // Student settings
        set_config('lms_student_registration', $request->input('lms_student_registration', 0));
        set_config('lms_student_role', $request->input('lms_student_role', 'subscriber'));
        set_config('lms_progress_tracking', $request->input('lms_progress_tracking', 0));
        set_config('lms_auto_complete_lesson', $request->input('lms_auto_complete_lesson', 0));
        set_config('lms_enable_reviews', $request->input('lms_enable_reviews', 0));
        
        // Instructor settings
        set_config('lms_instructor_application', $request->input('lms_instructor_application', 0));
        set_config('lms_instructor_commission', $request->input('lms_instructor_commission', 70));
        set_config('lms_auto_approve_instructor', $request->input('lms_auto_approve_instructor', 0));
        
        // Certificate settings
        set_config('lms_enable_certificates', $request->input('lms_enable_certificates', 0));
        set_config('lms_certificate_logo', $request->input('lms_certificate_logo'));
        set_config('lms_certificate_signature', $request->input('lms_certificate_signature'));
        set_config('lms_certificate_template', $request->input('lms_certificate_template', 'default'));
        
        // Email settings
        set_config('lms_email_new_course', $request->input('lms_email_new_course', 0));
        set_config('lms_email_course_completion', $request->input('lms_email_course_completion', 0));
        set_config('lms_email_enrollment', $request->input('lms_email_enrollment', 0));
        
        // Page settings
        set_config('lms_courses_page', $request->input('lms_courses_page'));
        set_config('lms_my_courses_page', $request->input('lms_my_courses_page'));
        set_config('lms_checkout_page', $request->input('lms_checkout_page'));
        set_config('lms_thank_you_page', $request->input('lms_thank_you_page'));
        set_config('lms_instructor_page', $request->input('lms_instructor_page'));
    }
}
