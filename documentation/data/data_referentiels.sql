-- WishListRole
INSERT INTO "wish_list_roles" ("id", "name", "created_at", "updated_at") VALUES
    (uuid_in((md5((random())::text))::cstring), 'owner', now(), now()),
    (uuid_in((md5((random())::text))::cstring), 'contributor', now(), now());
