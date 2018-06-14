var request = require("request");
var custom = require('../wash-test');
var base_url = "http://localhost/"

describe('MethodsController', () => {

    describe('Default', () => {
        
        it("GET 1", (done) => {
            request.get(base_url + 'methods', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe("default GET");
                done();
            });
        });
        it("GET 2", (done) => {
            custom.request(custom.method.Get, 'methods').then(response => {
                expect(response.code).toBe(custom.code.OK);
                expect(response.content).toBe("default GET");
                done();
            });
        });

        
        it("POST 1", (done) => {
            request.post(base_url + 'methods', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe("default POST");
                done();
            });
        });
        it("POST 2", (done) => {
            custom.request(custom.method.Post, 'methods').then(response => {
                expect(response.code).toBe(custom.code.OK);
                expect(response.content).toBe("default POST");
                done();
            });
        });

        it("PUT", (done) => {
            request.put(base_url + 'methods', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe("default PUT");
                done();
            });
        });

        it("CUSTOM", (done) => {
            custom.request('custom', 'methods').then(response => {
                expect(response.code).toBe(custom.code.OK);
                expect(response.content).toBe("default CUSTOM");
                done();
            });
        });
    });

    describe('Defined Route', () => {
        it("GET 1", (done) => {
            request.get(base_url + 'methods/defined/', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe("defined GET");
                done();
            });
        });
        it("GET 2", (done) => {
            custom.request(custom.method.Get, 'methods/defined/').then(response => {
                expect(response.code).toBe(custom.code.OK);
                expect(response.content).toBe("defined GET");
                done();
            });
        });

        it("POST 1", (done) => {
            request.post(base_url + 'methods/defined/', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe("defined POST");
                done();
            });
        });
        it("POST 2", (done) => {
            custom.request(custom.method.Post, 'methods/defined/').then(response => {
                expect(response.code).toBe(custom.code.OK);
                expect(response.content).toBe("defined POST");
                done();
            });
        });

        it("PUT", (done) => {
            request.put(base_url + 'methods/defined/', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe("defined PUT");
                done();
            });
        });

        it("CUSTOM", (done) => {
            custom.request('custom', 'methods/defined/').then(response => {
                expect(response.code).toBe(custom.code.OK);
                expect(response.content).toBe("defined CUSTOM");
                done();
            });
        });
    });

    // describe('Param Route', () => {
        
    //     let param = 'gybiunyg34u5fc';
    //     let bodyReq = JSON.stringify({param:param});
      
    //     it("GET 1", (done) => {
    //         request.get(base_url + 'methods/param/' + param, (error, response, body) => {
    //             expect(response.statusCode).toBe(200);
    //             expect(body).toBe("param GET " + param);
    //             done();
    //         });
    //     });

    //     it("GET 2", (done) => {
    //         custom.request(custom.method.Get, 'methods/param/' + param).then(response => {
    //             expect(response.code).toBe(custom.code.OK);
    //             expect(response.content).toBe("param GET " + param);
    //             done();
    //         });
    //     });
     
    //     it("POST 1", (done) => {
    //         request.post(base_url + 'methods/param/', { body: bodyReq },(error, response, body) => {
    //             expect(response.statusCode).toBe(200);
    //             expect(body).toBe("param POST " + param);
    //             done();
    //         });
    //     });
    //     it("POST 2", (done) => {
    //         custom.request(custom.method.Post, 'methods/param/', bodyReq).then(response => {
    //             expect(response.code).toBe(custom.code.OK);
    //             expect(response.content).toBe("param POST " + param);
    //             done();
    //         });
    //     });

    //     it("PUT", (done) => {
    //         request.put(base_url + 'methods/param/', { body: bodyReq }, (error, response, body) => {
    //             expect(response.statusCode).toBe(200);
    //             expect(body).toBe("param PUT " + param);
    //             done();
    //         });
    //     });

    //     it("CUSTOM", (done) => {
    //         custom.request('custom', 'methods/param/', bodyReq).then(response => {
    //             expect(response.code).toBe(custom.code.OK);
    //             expect(response.content).toBe("param CUSTOM " + param);
    //             done();
    //         });
    //     });
    // });

});