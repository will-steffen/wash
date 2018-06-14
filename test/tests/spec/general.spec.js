var request = require("request");
var base_url = "http://localhost/";

describe('General', () =>  {
           

    it("No controller defined", (done) => {
        request.get(base_url+'none', (error, response, body) => {
            expect(response.statusCode).toBe(404);
            expect(body).toBe("Not Found");
            done();
        });
    });

   
});