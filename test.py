
import requests, json, time, csv

# TODO: Add your api key below
API_KEY = "c53be9d014a107e3b8bcff0862743018df7c2e0b6937abb64e3db3cd8cb28316"

# TODO: Set number of records to pull (-1 for all available records)
MAX_NUM_RECORDS = 150

# NO CHANGES NEEDED BELOW HERE
PDL_URL = "https://api.peopledatalabs.com/v5/company/search"
request_header = {
    "Content-Type": "application/json",
    "X-api-key": API_KEY
}

ES_QUERY = {
    "query": {
        "bool": {
            "must": [
                {
                    "term": {
                        "name": "harbour.space"
                    }
                }
            ]
        }
    }
}

num_records_to_request = 100
params = {
    "dataset": "all",
    "query": json.dumps(ES_QUERY),
    "size": num_records_to_request,
    "pretty": True
}

# Pull all results in multiple batches
batch = 1
all_records = []
start_time = time.time()
while batch == 1 or params["scroll_token"]:
    if MAX_NUM_RECORDS != -1:
        # Update num_records_to_request
        # Compute the number of records left to pull
        num_records_to_request = MAX_NUM_RECORDS - len(all_records)
        # Clamp this number between 0 and 100
        num_records_to_request = max(0, min(num_records_to_request, 100))

    if num_records_to_request == 0:
        break

    params["size"] = num_records_to_request
    response = requests.get(PDL_URL, headers=request_header, params=params).json()

    if batch == 1:
        print(f"{response['total']} available records in this search")

    all_records.extend(response.get("data", []))
    params["scroll_token"] = response.get("scroll_token")
    print(f"Retrieved {len(response.get('data', []))} records in batch {batch}")
    batch += 1

    if params["scroll_token"]:
        time.sleep(6)   # avoid hitting rate limit thresholds


end_time = time.time()
runtime = end_time - start_time

print(f"Successfully recovered {len(all_records)} profiles in "
      f"{batch} batches [{runtime} seconds]")


def save_profiles_to_csv(profiles, filename, fields=[], delim=","):
    """Save profiles to csv (utility function)"""

    # Define header fields
    if fields == [] and len(profiles) > 0:
        fields = profiles[0].keys()

    with open(filename, "w") as csvfile:
        # Write csv file
        writer = csv.writer(csvfile, delimiter=delim)

        # Write Header:
        writer.writerow(fields)

        count = 0
        for profile in profiles:
            # Write Body:
            writer.writerow([profile[field] for field in fields])
            count += 1
            print(f"Wrote {count} lines to: '{filename}'")


# Use utility function to save profiles to csv
csv_header_fields = ["name", "industry", "linkedin_url", "website", "type", "size"]
csv_filename = "all_company_profiles.csv"
save_profiles_to_csv(all_records, csv_filename, csv_header_fields)