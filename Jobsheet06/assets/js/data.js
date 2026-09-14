async function muatData(file) {
    try {
        const res = await fetch(file);

        if (!res.ok) {
            throw new Error("Gagal mengambil data");
        }

        const data = await res.json();

        console.log(data);

        return data;

    } catch (err) {
        console.error(err.message);
    }
}