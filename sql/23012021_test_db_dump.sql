CREATE TABLE `users` (
    `id` bigint(11) NOT NULL,
    `email` varchar(256) NOT NULL,
    `password` varchar(256) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `token_users_list` (
    `id` bigint(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `verify_token` text NOT NULL,
    `refresh_token` text NOT NULL,
    `refresh_token_expired_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `token_blacklist` (
    `id` bigint(11) NOT NULL,
    `token` text NOT NULL,
    `expired_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
