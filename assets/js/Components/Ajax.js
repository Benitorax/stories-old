export default {
    get(url) {
        return axios.get('/api/' + url)
    },
    post(url, data) {
        return axios.post('/api/' + url, data)
    }
}