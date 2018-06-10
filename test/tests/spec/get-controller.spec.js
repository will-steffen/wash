var request = require("request");
var custom = require('../wash-test');

var base_url = "http://localhost/"

describe('GetController', () =>  {
    describe("GET /", () => {
        
        var expected = "default GET";

        it("returns status code 200", (done) => {
            request.get(base_url+'get', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe(expected);
                done();
            });
        });

        it("returns status code 200", (done) => {
            custom.request(custom.method.Get, 'get').then(response => {
                expect(response.code).toBe(custom.code.OK);
                expect(response.content).toBe(expected);
                done();
            });
        });

    });
});

