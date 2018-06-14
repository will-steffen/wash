var request = require("request");
var base_url = "http://localhost/";

describe('PostController', () =>  {

    it("Default without end bar", (done) => {
        request.post(base_url+'post', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("default POST");
            done();
        });
    });

    it("Default with end bar", (done) => {
        request.post(base_url+'post/', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("default POST");
            done();
        });
    });

    it("Defined without end bar", (done) => {
        request.post(base_url+'post/defined', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("defined POST");
            done();
        });
    });

    it("Defined with end bar", (done) => {
        request.post(base_url+'post/defined/', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("defined POST");
            done();
        });
    });    

    it("Param", (done) => {
        let param = "123";
        let body = JSON.stringify( { param1: param } );
        request.post(base_url+'post/param/', { body: body }, (error, response, body) => {            
            expect(response.statusCode).toBe(200);
            expect(body).toBe("param POST " + param);
            done();
        });
    });

    it("Params", (done) => { 
        let param1 = "12341234";
        let param2 = "rhrtyh";
        let param3 = "45674rhtyh";
        let body = JSON.stringify({
            param1: param1,
            param2: param2,
            param3: param3
        });
        request.post(base_url+'post/params', { body: body }, (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("params POST "+param1+", "+param2+", "+param3);
            done();
        });
    });

    it("Json Response + '-' route", (done) => {
        let param1 = "12312";
        let param2 = "rhrtyh";
        let bodyReq = JSON.stringify({
            param1: param1,
            param2: param2
        });
        request.post(base_url+'post/params-json', { body: bodyReq }, (error, response, body) => {
            expect(response.statusCode).toBe(200);
            body = JSON.parse(body);
            expect(body['message']).toBe("params Json POST");
            expect(body['param1']).toBe(param1);
            expect(body['param2']).toBe(param2);
            done();
        });
    });

    it("Route Params", (done) => { 
        let param1 = "12341234";
        let param2 = "rhrtyh";
        let param3 = "45674rhtyh";
        let body = JSON.stringify({
            param2: param2,
            param3: param3
        });
        request.post(base_url+'post/with-route-param/'+param1, { body: body }, (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("params POST "+param1+", "+param2+", "+param3);
            done();
        });
    });


    it("Wrong params number", (done) => { 
        let param1 = "12312";
        let bodyReq = JSON.stringify({
            param1: param1
        });
        request.post(base_url+'post/params/', { body: bodyReq }, (error, response, body) => {
            expect(response.statusCode).toBe(500);
            expect(body).toBe("ERROR");
            done();
        });
    });

    it("No route defined", (done) => { 
        request.post(base_url+'post/none/', (error, response, body) => {
            expect(response.statusCode).toBe(404);
            expect(body).toBe("Not Found");
            done();
        });
    });
});
