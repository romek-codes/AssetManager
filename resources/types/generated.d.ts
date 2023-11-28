declare namespace App.Data {
export type AssetComponentData = {
id: number;
name: string;
category: App.Data.CategoryData | null;
assignedUser: App.Data.AssignedUserData | null;
image: App.Data.ImageData | null;
};
export type AssetData = {
id: number;
name: string;
category: App.Data.CategoryData | null;
assignedUser: App.Data.AssignedUserData | null;
image: App.Data.ImageData | null;
assetComponents: Array<App.Data.AssetComponentData> | null;
};
export type AssignedUserData = {
firstName: string;
lastName: string;
};
export type CategoryData = {
id: number;
name: string;
};
export type ImageData = {
name: string;
url: string;
};
}
