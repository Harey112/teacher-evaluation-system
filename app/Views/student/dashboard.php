<style>
    .content {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .tile {
        background-color: #ffffff;
        width: 300px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .tile:hover {
        transform: translateY(-5px);
    }

    .tile h1 {
        font-size: 18px;
        color: #293777;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .tile p {
        font-size: 14px;
        color: #666;
        cursor: pointer;
    }

    .tile p:hover {
        color: #293777;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .tile {
            width: 100%;
        }
    }
</style>
<div class="tile">
    <h1>Evaluate Faculty</h1>
    <div>
        <p>More Info...</p>
    </div>
</div>
<div class="tile">
    <h1>Pending Evaluation</h1>
    <div>
        <p>More Info...</p>
    </div>
</div>