# phprestrict
Dokuwiki plugin to restrict php inclusion to pages by namespace or name.

Overrides the current PHP setting, which enables PHP on all pages.

Enable PHP by namespace ("fred:"), page ("fred:derf") and page-prefix ("fred:php*). You can then use the ACL to determine what users have the ability to edit PHP pages.

You can also disable "view source" on PHP pages (recommended).
