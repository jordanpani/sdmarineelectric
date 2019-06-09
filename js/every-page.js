function delete_cookie(name, path) {
    if (path==null) path = "/";
    document.cookie = name +'=; Path=' + path + '; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
