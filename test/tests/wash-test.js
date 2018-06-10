
const http = require('http');

let Method = {
    Get: 'get',
    Post: 'post',
    Put: 'put',
    Delete: 'delete',
    Options: 'options'
};

let Code = {
    OK: 'OK',
    UNAUTHORIZED: 'Unauthorized',
    FORBIDDEN: 'Forbidden',
    NOT_FOUND: 'Not Found',
    ERROR: 'Internal Server Error'
};

function Resp(code, content) {
    this.code = code;
    this.content = content;
}

function Request(method, route, data) {
    return new Promise((res, rej) => {
        let request = http.request({
            path: '/' + route,
            method: method,
            headers: {
                'Content-Type': 'application/json',
            }
        }, function(response){
            var body = '';
            response.on('data', function(d) {
                body += d;
            });
            response.on('end', function() {                
                res(new Resp(response.statusMessage, body));
            });
        });
        if(data){
            request.write(JSON.stringify(data));
        }
        request.end();
    });    
}


exports.Resp = Resp;
exports.method = Method;
exports.request = Request;
exports.code = Code;
