<?php
\ = \App\Models\User::where('email', 'adityaamishra026@gmail.com')->first();
\->is_admin = true;
\->save();
exit;
