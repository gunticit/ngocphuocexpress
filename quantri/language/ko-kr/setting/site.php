<?php
// Heading
$_['heading_title']                = 'Settings';

// Text
$_['text_success']                 = 'Success: You have modified settings!';
$_['text_items']                   = 'Items';
$_['text_tax']                     = 'Taxes';
$_['text_account']                 = 'Account';
$_['text_checkout']                = 'Checkout';
$_['text_stock']                   = 'Stock';
$_['text_image_manager']           = 'Image Manager';
$_['text_browse']                  = 'Browse';
$_['text_clear']                   = 'Clear';
$_['text_shipping']                = 'Shipping Address';
$_['text_payment']                 = 'Payment Address';

// Column
$_['column_name']                  = 'Site Name';
$_['column_url']	               = 'Site URL';
$_['column_action']                = 'Action';

// Entry
$_['entry_url']                    = 'Site URL:<br /><span class="help">Include the full URL to your Site. Make sure to add \'/\' at the end. Example: http://www.yourdomain.com/path/<br /><br />Don\'t use directories to create a new Site. You should always point another domain or sub domain to your hosting.</span>';
$_['entry_ssl']                    = 'SSL URL:<br /><span class="help">SSL URL to your Site. Make sure to add \'/\' at the end. Example: http://www.yourdomain.com/path/<br /><br />Don\'t use directories to create a new Site. You should always point another domain or sub domain to your hosting.</span>';
$_['entry_name']                   = 'Site Name:';
$_['entry_owner']                  = 'Site Owner:';
$_['entry_address']                = 'Address:';
$_['entry_email']                  = 'E-Mail:';
$_['entry_telephone']              = 'Telephone:';
$_['entry_fax']                    = 'Fax:';
$_['entry_title']                  = 'Title:';
$_['entry_meta_description']       = 'Meta Tag Description:';
$_['entry_layout']                 = 'Default Layout:';
$_['entry_template']               = 'Template:';
$_['entry_country']                = 'Country:';
$_['entry_zone']                   = 'Region / State:';
$_['entry_language']               = 'Language:';
$_['entry_currency']               = 'Currency:';
$_['entry_thread_limit'] 	       = 'Default Items Per Page (thread):<br /><span class="help">Determines how many thread items are shown per page (Posts, categories, etc)</span>';
$_['entry_tax']                    = 'Display Prices With Tax:';
$_['entry_tax_default']            = 'Use Site Tax Address:<br /><span class="help">Use the Site address to calculate taxes if no one is logged in. You can choose to use the Site address for the customers shipping or payment address.</span>';
$_['entry_tax_customer']           = 'Use Customer Tax Address:<br /><span class="help">Use the customers default address when they login to calculate taxes. You can choose to use the default address for the customers shipping or payment address.</span>';
$_['entry_customer_group']         = 'Customer Group:<br /><span class="help">Default customer group.</span>';
$_['entry_customer_group_display'] = 'Customer Groups:<br /><span class="help">Display customer groups that new customers can select to use such as wholesale and business when signing up.</span>';
$_['entry_customer_price']         = 'Login Display Prices:<br /><span class="help">Only show prices when a customer is logged in.</span>';
$_['entry_account']                = 'Account Terms:<br /><span class="help">Forces people to agree to terms before an account can be created.</span>';
$_['entry_cart_weight']            = 'Display Weight on Cart Page:';
$_['entry_guest_checkout']         = 'Guest Checkout:<br /><span class="help">Allow customers to checkout without creating an account. This will not be available when a downloadable Post is in the shopping cart.</span>';
$_['entry_checkout']               = 'Checkout Terms:<br /><span class="help">Forces people to agree to terms before an a customer can checkout.</span>';
$_['entry_order_status']           = 'Order Status:<br /><span class="help">Set the default order status when an order is processed.</span>';
$_['entry_stock_display']          = 'Display Stock:<br /><span class="help">Display stock quantity on the Post page.</span>';
$_['entry_stock_checkout']         = 'Stock Checkout:<br /><span class="help">Allow customers to still checkout if the Posts they are ordering are not in stock.</span>';
$_['entry_logo']                   = 'Site Logo:';
$_['entry_icon']                   = 'Icon:<br /><span class="help">The icon should be a PNG that is 16px x 16px.</span>';
$_['entry_image_thread']         = 'Thread Image Size:';
$_['entry_image_thumb']            = 'Post Image Thumb Size:';
$_['entry_image_popup']            = 'Post Image Popup Size:';
$_['entry_image_post']          = 'Post Image List Size:';
$_['entry_image_additional']       = 'Additional Post Image Size:';
$_['entry_image_related']          = 'Related Post Image Size:';
$_['entry_image_compare']          = 'Compare Image Size:';
$_['entry_image_wishlist']         = 'Wish List Image Size:';
$_['entry_image_cart']             = 'Cart Image Size:';
$_['entry_secure']                 = 'Use SSL:<br /><span class="help">To use SSL check with your host if a SSL certificate is installed.</span>';

// Error
$_['error_warning']                = 'Warning: Please check the form carefully for errors!';
$_['error_permission']             = 'Warning: You do not have permission to modify Sites!';
$_['error_name']                   = 'Site Name must be between 3 and 32 characters!';
$_['error_owner']                  = 'Site Owner must be between 3 and 64 characters!';
$_['error_address']                = 'Site Address must be between 10 and 256 characters!';
$_['error_email']                  = 'E-Mail Address does not appear to be valid!';
$_['error_telephone']              = 'Telephone must be between 3 and 32 characters!';
$_['error_url']                    = 'Site URL required!';
$_['error_title']                  = 'Title must be between 3 and 32 characters!';
$_['error_limit']       	       = 'Limit required!';
$_['error_customer_group_display'] = 'You must include the default customer group if you are going to use this feature!';
$_['error_image_thumb']            = 'Post Image Thumb Size dimensions required!';
$_['error_image_popup']            = 'Post Image Popup Size dimensions required!';
$_['error_image_Post']          = 'Post List Size dimensions required!';
$_['error_image_Thread']         = 'Thread List Size dimensions required!';
$_['error_image_additional']       = 'Additional Post Image Size dimensions required!';
$_['error_image_related']          = 'Related Post Image Size dimensions required!';
$_['error_image_compare']          = 'Compare Image Size dimensions required!';
$_['error_image_wishlist']         = 'Wish List Image Size dimensions required!';
$_['error_image_cart']             = 'Cart Image Size dimensions required!';
$_['error_default']                = 'Warning: You can not delete your default Site!';
$_['error_site']                  = 'Warning: This Site cannot be deleted as it is currently assigned to %s orders!';
?>