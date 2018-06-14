var request = require("request");
var base_url = "http://localhost/";

describe('GetController', () =>  {    

    it("Default without end bar", (done) => {
        request.get(base_url+'get', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("default GET");
            done();
        });
    });

    it("Default with end bar", (done) => {
        request.get(base_url+'get/', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("default GET");
            done();
        });
    });

    it("Defined without end bar", (done) => {
        request.get(base_url+'get/defined', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("defined GET");
            done();
        });
    });

    it("Defined with end bar", (done) => {
        request.get(base_url+'get/defined/', (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("defined GET");
            done();
        });
    });    

    it("Param", (done) => {
        let param = "123";
        request.get(base_url+'get/param/'+param, (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("param GET " + param);
            done();
        });
    });

    it("Params", (done) => { 
        let param1 = "12341234";
        let param2 = "rhrtyh";
        let param3 = "45674rhtyh";
        request.get(base_url+'get/params/'+param1+'/'+param2+'/'+param3, (error, response, body) => {
            expect(response.statusCode).toBe(200);
            expect(body).toBe("params GET "+param1+", "+param2+", "+param3);
            done();
        });
    });

    it("Json Response + '-' route", (done) => {
        let param1 = "12312";
        let param2 = "rhrtyh";
        request.get(base_url+'get/params-json/'+param1+'/'+param2, (error, response, body) => {
            expect(response.statusCode).toBe(200);
            body = JSON.parse(body);
            expect(body['message']).toBe("params Json GET");
            expect(body['param1']).toBe(param1);
            expect(body['param2']).toBe(param2);
            done();
        });
    });



    it("Defined error 500", (done) => {
        request.get(base_url+'get/error', (error, response, body) => {
            expect(response.statusCode).toBe(500);
            expect(body).toBe("error GET");
            done();
        });
    });

    it("Wrong params number", (done) => { 
        let param1 = "12341234";
        let param2 = "rhrtyh";
        request.get(base_url+'get/params/'+param1+'/'+param2+'/', (error, response, body) => {
            expect(response.statusCode).toBe(404);
            expect(body).toBe("Not Found");
            done();
        });
    });

    it("No route defined", (done) => { 
        request.get(base_url+'get/none/', (error, response, body) => {
            expect(response.statusCode).toBe(404);
            expect(body).toBe("Not Found");
            done();
        });
    });

});

