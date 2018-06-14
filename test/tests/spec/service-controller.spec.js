var request = require("request");
var base_url = "http://localhost/";

describe('ServiceController', () =>  {
    describe("GET /", () => {
                
        var expected = "default GET";

        it("returns status code 200", (done) => {
            request.get(base_url+'get', (error, response, body) => {
                expect(response.statusCode).toBe(200);
                expect(body).toBe(expected);
                done();
            });
        });

    });
});
